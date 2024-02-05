
grapple.E.insert = function (l, i) {
    if (!i) return;
    let p = {
        0: "beforebegin",
        1: "afterbegin",
        2: "beforeend",
        3: "afterend",
    };
    if (typeof i == "object") this.insertAdjacentElement(p[l], i);
    else if (i[0] == "<") this.insertAdjacentHTML(p[l], i);
    else this.insertAdjacentHTML(p[l], i);
};

/* ajax form submittion */
HTMLFormElement.prototype.ajaxSubmit = function (c = {}, r) {
    this.addEventListener("submit", (e) => {
        e.preventDefault();
        c.form = this;
        ajax({ url: this.get("action"), method: this.get("method"), ...c });
    });
};
/* ajax form submittion using button */
HTMLButtonElement.prototype.ajaxSubmit = function (config = {}, reset) {
    this.addEventListener("click", (e) => {
        e.preventDefault();
        this.form.ajaxSubmit(config, reset);
    });
};
/* Localstorage */
localStorage.__proto__.getJson = function (item) {
    return JSON.parse(this.getItem(item));
};
localStorage.__proto__.setJson = function (key, item) {
    return this.setItem(key, JSON.stringify(item));
};
function text_break(node) {
    let content = node.innerText;
    node.innerText = "";
    for (let i = 0; i < content.length; i++) {
        node.append(`<span style="--i:${i}">${content[i]}</span>`);
    }
}

/** Ripple Effect */
grapple.E.ripple = function () {
    this.addEventListener("click", (e) => {
        let span = document.createElement("span");
        span.addClass("ripple");
        span.addCSS({ top: e.offsetY + "px", left: e.offsetX + "px" });
        this.append(span);
        setTimeout(() => {
            span.remove();
            this.blur();
        }, 500);
    });
};

/* Custom events and functionalities */
grapple.E.drag = function () {
    let coors = [];
    let set = [];
    __mouseDown__ = (e) => {
        this.addCSS("cursor", "move");
        coors = [e.offsetX, e.offsetY];
        document.addEventListener("mousemove", __mouseMove__);
        document.addEventListener("mouseup", __mouseUp__);
    };
    __touchStart__ = (e) => {
        coors = [
            e.changedTouches[0].clientX - this.offsetLeft,
            e.changedTouches[0].clientY - this.offsetTop,
        ];
        document.addEventListener("touchmove", __touchMove__);
        document.addEventListener("touchend", __touchEnd__);
    };
    __mouseMove__ = (e) => {
        let setX = e.clientX - coors[0];
        let setY = e.clientY - coors[1];
        set(setX, setY);
    };
    __touchMove__ = (e) => {
        e.preventDefault();
        let setX = e.changedTouches[0].clientX - coors[0];
        let setY = e.changedTouches[0].clientY - coors[1];
        set(setX, setY);
    };
    set = (setX, setY) => {
        let inn = [
            innerWidth - this.offsetWidth,
            innerHeight - this.offsetHeight,
        ];
        this.addCSS({
            top: setY < 0 ? 0 : setY > inn[1] ? inn[1] : setY + "px",
            left: setX < 0 ? 0 : setX > inn[0] ? inn[0] : setX + "px",
            bottom: "unset",
            right: "unset",
            margin: "unset",
        });
    };
    __mouseUp__ = () => {
        coors = [];
        this.addCSS("cursor", "unset");
        document.removeEventListener("mousemove", __mouseMove__);
        document.removeEventListener("mouseup", __mouseUp__);
    };
    __touchEnd__ = () => {
        coors = [];
        document.removeEventListener("touchmove", __touchMove__);
        document.removeEventListener("touchend", __touchEnd__);
    };
    this.addEventListener("mousedown", __mouseDown__);
    this.addEventListener("touchstart", __touchStart__);
};
grapple.E.isVisible = function (limit) {
    let box = this.getBoundingClientRect();
    let center = { x: limit ?? box.width / 2, y: limit ?? box.height / 2 };
    return (
        box.x + center.x > 0 &&
        box.y + center.y > 0 &&
        box.right - center.x < innerWidth &&
        box.bottom - center.y < innerHeight
    );
};
grapple.E.onVisible = function (callback, limit) {
    this.visiblityState = this.isVisible(limit) ? "visible" : "hidden";
    let y = () => {
        if (this.isVisible(limit) && this.visiblityState == "hidden") {
            this.visiblityState = "visible";
            callback();
        }
    };
    document.addEventListener("scroll", y);
    return {
        cancel: () => document.removeEventListener("scroll", y),
    };
};
grapple.E.onHide = function (callback, limit) {
    this.visiblityState = this.isVisible(limit) ? "visible" : "hidden";
    let y = () => {
        if (!this.isVisible(limit) && this.visiblityState == "visible") {
            this.visiblityState = "hidden";
            callback();
        }
    };
    document.addEventListener("scroll", y);
    return {
        cancel: () => document.removeEventListener("scroll", y),
    };
};
grapple.E.onVisiblityChange = function (visible, hide, limit) {
    let h = this.onVisible(visible, limit);
    let v = this.onHide(hide, limit);
    return {
        cancel: () => {
            h.cancel();
            v.cancel();
        },
    };
};
/** GO TO TOP */
class go_to_top {
    constructor(config) {
        this.button = config.button;
        this.margin = config.margin ?? 200;
        this.active = config.active ?? "active";
        this.onScroll = config.onScroll;
        this.button.addEventListener("click", this.go);
        window.addEventListener("scroll", this.changeVisibilty);
        this.changeVisibilty();
    }
    go = () => {
        window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    };
    show = () => this.button.addClass(this.active);
    hide = () => this.button.removeClass(this.active);
    changeVisibilty = () => {
        window.pageYOffset > this.margin ? this.show() : this.hide();
        this.onScroll();
    };
}
class Slider {
    constructor(config) {
        this.config = config;
        this.slider = config.slider;
        this.slides_wrapper = config.slides_wrapper;
        config.slides_wrapper.addCSS(
            "transition",
            `all ${config.slide_time}ms`
        );
        this.slides = config.slides_wrapper.$(".slide");
        this.countSlides = this.slides.length;
        this.currentSlide = 0;
        this.displayingSlide = 0;
        this.sliding = false;

        if (config.infinite) {
            this.displayingSlide = 1;
            this.#activateInfinite();
        }

        config.slide_next_btn.addEventListener("click", this.next_slide);
        config.slide_previous_btn.addEventListener(
            "click",
            this.previous_slide
        );
        if ("slide_bottom_nav" in config) {
            this.bottom_nav_btns = [];
            this.slide_bottom_nav = config.slide_bottom_nav;
            this.#createBottomNav();
        }
        document.addEventListener("keydown", ({ key }) => {
            if (key == "ArrowRight") {
                this.next_slide();
            } else if (key == "ArrowLeft") {
                this.previous_slide();
            }
        });
        this.#reflectSlide();
    }
    next_slide = () => {
        if (this.sliding) return;
        this.currentSlide = (this.currentSlide + 1) % this.countSlides;
        if (this.infinite) {
            this.displayingSlide++;
        } else {
            this.displayingSlide = this.currentSlide;
        }
        this.#reflectSlide();
    };
    previous_slide = () => {
        if (this.sliding) return;
        this.currentSlide =
            (this.currentSlide + this.countSlides - 1) % this.countSlides;
        if (this.infinite) {
            this.displayingSlide--;
        } else {
            this.displayingSlide = this.currentSlide;
        }
        this.#reflectSlide();
    };
    displaySlide = (i) => {
        this.displayingSlide = this.currentSlide = i;
        if (this.infinite) {
            this.displayingSlide = i + 1;
        }
        this.#reflectSlide();
    };
    #reflectSlide = () => {
        this.#toggleEvents();
        this.#activate_auto_slide();
        this.slides_wrapper.addCSS(
            "transform",
            `translatex(-${this.displayingSlide * 100}%)`
        );
        if (this.infinite) {
            if (this.displayingSlide == this.countSlides + 1) {
                this.displayingSlide = 1;
            } else if (this.displayingSlide == 0) {
                this.displayingSlide = this.countSlides;
            }
            setTimeout(() => {
                this.slides_wrapper.addCSS(
                    "transform",
                    `translatex(-${this.displayingSlide * 100}%)`
                );
                this.config.slides_wrapper.addCSS("transition", `unset`);
                setTimeout(() => {
                    this.config.slides_wrapper.addCSS(
                        "transition",
                        `all ${this.config.slide_time}ms`
                    );
                }, 100);
            }, this.config.slide_time);
        }
        for (let i = 0; i < this.bottom_nav_btns.length; i++) {
            if (i == this.currentSlide) {
                this.slides[i].addClass("active");
                this.bottom_nav_btns[i].addClass("active");
            } else {
                this.slides[i].removeClass("active");
                this.bottom_nav_btns[i].removeClass("active");
            }
        }
    };
    #toggleEvents = () => {
        this.sliding = true;
        setTimeout(() => {
            this.sliding = false;
        }, this.config.slide_time + 150);
    };
    #createBottomNav = () => {
        for (let i = 0; i < this.countSlides; i++) {
            let span = document.createElement("span");
            span.addEventListener("click", () => this.displaySlide(i));
            this.slide_bottom_nav.append(span);
            this.bottom_nav_btns.push(span);
        }
    };
    #activate_auto_slide = () => {
        if (this.config.auto_slide) {
            if (this.auto_slide_interval)
                clearInterval(this.auto_slide_interval);
            this.auto_slide_interval = setInterval(() => {
                this.next_slide();
            }, this.config.auto_slide_time ?? 3000);
        }
    };
    #activateInfinite = () => {
        this.infinite = true;
        this.slides_wrapper.prepend(
            this.slides[this.countSlides - 1].cloneNode(true)
        );
        this.slides_wrapper.append(this.slides[0].cloneNode(true));
    };
}
/** Under Maintence */
grapple.E.checkSwipe = function ({ left, right, top, bottom }, threshold = 50) {
    let [start_coor, current_coor] = [{}, {}];
    let swipe = null;
    let __init__ = (e) => {
        start_coor = {
            x: e.changedTouches[0].clientX,
            y: e.changedTouches[0].clientY,
        };
        this.addEventListener("touchmove", __move__, { passive: false });
        this.addEventListener("touchend", __end__);
    };
    let __move__ = (e) => {
        // e.preventDefault();
    };
    let __end__ = (e) => {
        current_coor = {
            x: e.changedTouches[0].clientX,
            y: e.changedTouches[0].clientY,
        };
        if (
            Math.abs(current_coor.x - start_coor.x) >
            Math.abs(current_coor.y - start_coor.y)
        ) {
            if (Math.abs(current_coor.x - start_coor.x) > threshold) {
                current_coor.x > start_coor.x ? right() : left();
            }
        } else {
            if (Math.abs(current_coor.y - start_coor.y) > threshold) {
                current_coor.y > start_coor.y ? bottom() : top();
            }
        }
    };
    this.addEventListener("touchstart", __init__);
    return swipe;
};
