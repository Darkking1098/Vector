(() => {
    let scrollPercentage;
    ajax = (reqConfig) => {
        if (!reqConfig.url) throw new Error("Request url not defined");
        let xmlObject = new XMLHttpRequest();
        if (!("async" in reqConfig)) reqConfig.async = true;
        let method = (reqConfig.method || "get").toUpperCase();
        xmlObject.timeout = reqConfig.timeout || 0;
        let reqData = new FormData(reqConfig.form);
        if (reqConfig.data) {
            if (method == "GET") {
                reqData = new URLSearchParams(reqConfig.data).toString();
                reqConfig.url = reqConfig.url + "?" + reqData;
            } else {
                for (const key in reqConfig.data)
                    reqData.append(key, reqConfig.data[key]);
            }
        }
        if (reqConfig.files) {
            let files = reqConfig.files["docs[]"];
            for (const key in reqConfig.files)
                for (let i = 0; i < files.length; i++)
                    reqData.append(key, files[i]);
        }
        xmlObject.open(method, reqConfig.url, reqConfig.async);
        for (const k in reqConfig.headers)
            xmlObject.setRequestHeader(k, reqConfig.headers[k]);
        xmlObject.onloadstart = reqConfig.before;
        xmlObject.onload = () => {
            if (xmlObject.status == 200)
                (reqConfig.success || console.log)(xmlObject.response);
            else if (reqConfig.error) reqConfig.error();
        };
        xmlObject.onabort = reqConfig.abort;
        xmlObject.onerror = reqConfig.error;
        xmlObject.ontimeout = reqConfig.onTimeout;
        xmlObject.onloadend = reqConfig.after;
        xmlObject.upload.onloadstart = reqConfig.beforeUpload;
        xmlObject.upload.onloadend = reqConfig.afterupload;
        xmlObject.upload.onprogress = reqConfig.progress;
        method == "GET" ? xmlObject.send() : xmlObject.send(reqData);
        return xmlObject;
    };
    ajaxSubmit = (form, config) => {
        if (!form.node instanceof HTMLFormElement) {
            throw new Error("Request url not defined");
        }
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            c.form = form.node;
            ajax({
                url: form.get("action"),
                method: form.get("method"),
                ...config,
            });
        });
    };
    class VUNode {
        static plugins = [];
        constructor(node) {
            this.node = node;
            node.VU = this;
            VUNode.plugins.forEach((plugin) => {
                this[plugin.name] = new plugin(this);
            });
            return this.node;
        }
        $(selector){
            return new VUNodeList([...this.node.querySelectorAll(selector)]);
        };
        get(attr) {
            return this.node.getAttribute(attr);
        }
        set(attr, val) {
            return this.node.setAttribute(attr, val);
        }
        hasClass(CN) {
            return this.node.classList.contains(CN);
        }
        addClass(CN) {
            let classes = typeof CN == "string" ? CN.split(" ") : CN;
            this.node.classList.add(...classes);
            return this;
        }
        removeClass(CN) {
            if (CN == "*") {
                this.node.classList = [];
            } else {
                let classes = typeof CN == "string" ? CN.split(" ") : CN;
                this.node.classList.remove(...classes);
            }
            return this;
        }
        toggleClass(c) {
            return this.hasClass(c) ? this.removeClass(c) : this.addClass(c);
        }
        timoutClass(c, t = 3000, ca) {
            this.node.addClass(c);
            setTimeout(() => this.node.removeClass(c, ca), t);
            return this;
        }
        addCSS(prop, val) {
            if (typeof prop == "object" || val) {
                let x = {};
                val ? (x[prop] = val) : (x = prop);
                for (const k in x) {
                    if (/-/.test(k)) this.node.style.setProperty(k, x[k]);
                    this.node.style[k] = x[k];
                }
            } else this.node.style = prop;
            return this;
        }
        addAttr(prop, val) {
            if (val) this.set(prop, val);
            else
                for (const k in prop)
                    k.toLowerCase() == "style"
                        ? this.addCSS(prop[k])
                        : this.set(k, prop[k]);
            return this;
        }
        static registerPlugin(x) {
            this.plugins.push(x);
        }
    }
    class VUNodeList {
        constructor(nodes) {
            this.nodes = nodes.map((x) => new VUNode(x));
            this.nodes.VU = this;
            return this.nodes;
        }
        perform(x) {
            for (let i = 0; i < this.nodes.length; i++) {
                x(this.nodes[i].VU, i, this.nodes);
            }
        }
    }
    function $(selector) {
        return selector[0] == "#" && !/[.:\[ >]/.test(selector)
            ? new VUNode(document.getElementById(selector.slice(1)))
            : new VUNodeList([...document.querySelectorAll(selector)]);
    }
    function upScrPer() {
        scrollPercentage =
            window.scrollY <= 0
                ? 0
                : (window.scrollY * 100) /
                  (document.documentElement.scrollHeight - innerHeight);
    }
    /* Window helper variables */
    let dom = new VUNode(document.documentElement);

    upScrPer();
    window.addEventListener("scroll", upScrPer);
    let VU = { ajax, VUNode, VUNodeList, scrollPercentage, dom };
    window.$ = $;
    window.VU = VU;
})();
// Themes Add On
(() => {
    if (!window.VU) throw new Error("Vector is not there");

    class VUTheme {
        constructor(themeName, themeColor) {
            this.themeName = themeName;
            this.themeColor = themeColor;
        }
        apply() {
            let x;
            VU.dom.set("data-theme", this.themeName);
            if ((x = $('meta[name="theme-color"]').nodes[0]))
                x.add("content", this.themeColor);
            else {
                x = new VU.VUNode(document.createElement("meta"));
                x.addAttr({ name: "theme-color", content: this.themeColor });
                $("head").nodes[0].node.append(x.node);
            }
        }
    }
    class VUThemes {
        static themes = [];
        static activate() {
            this.themes.push(new VUTheme("LIGHT", "#ffffff"));
            this.themes.push(new VUTheme("DARK", "#000000"));

            this.currentTheme =
                localStorage.getItem("theme") ||
                VU.dom.get("data-theme") ||
                this.systemTheme;
            this.theme = this.currentTheme;
        }
        static get systemTheme() {
            let m = window.matchMedia("(prefers-color-scheme:dark)");
            m.onchange = () => (this.theme = m.matches ? "DARK" : "LIGHT");
            return m.matches ? "DARK" : "LIGHT";
        }
        registerTheme(themeName, themeColor) {
            this.themes.push(new VUTheme(themeName, themeColor));
        }
        /**
         * @param {any} themeName
         */
        static set theme(themeName) {
            this.themes.find((x) => x.themeName == themeName).apply();
        }
    }
    window.VU.VUThemes = VUThemes;
})();

(() => {
    class VUText {
        constructor(VUNode) {
            this.VUNode = VUNode;
            this.node = this.VUNode.node;
        }
        split() {
            let text = this.node.innerText;
            this.node.innerText = "";
            for (let i = 0; i < text.length; i++) {
                this.node.innerHTML += `<span style="--i:${i}">${text[i]}</span>`;
            }
        }
    }
    VU.VUNode.registerPlugin(VUText);
})();
