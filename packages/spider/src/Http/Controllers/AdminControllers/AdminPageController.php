<?php

namespace Vector\Spider\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use Vector\Spider\Http\controllers\Controller;
use Vector\Spider\database\Models\AdminPage;
use Vector\Spider\database\Models\AdminPageGroup;

class AdminPageController extends Controller
{
    static function get_pages()
    {
        return AdminPage::all()->toArray();
    }
    static function get_allowed_pages()
    {
        $allowed = [];
        $empController = new EmployeeController;
        $permission = $empController->get_permitted_pages();
        if ($permission[0] == "*") return self::get_pages();
        foreach (self::get_pages() as $page) {
            if (in_array($page['id'], $permission)) $allowed[] = $page;
        }
        return $allowed;
    }
    static function get_display_pages()
    {
        $allowed = [];
        foreach (self::get_allowed_pages() as $page) {
            if ($page['page_status'] && $page['page_can_display'])
            $allowed[] = $page;
        }
        return $allowed;
    }
    static function get_pagegroups()
    {
        return AdminPagegroup::orderBy('pagegroup_index', 'asc')->get()->toArray();
    }
    static function get_pages_in_group()
    {
        $groups = [];
        foreach (AdminPagegroup::with('admin_pages')->get()->toArray() as $group)
            if ($group['admin_pages']) $groups[] = $group;
        return $groups;
    }
    static function get_allowed_pages_in_group()
    {
        $groups = [];
        $empController = new EmployeeController;
        $permission = $empController->get_permitted_pages();
        $tmp_groups = self::get_pages_in_group();
        if ($permission[0] == "*") return $tmp_groups;
        for ($i = 0; $i < count($tmp_groups); $i++) {
            $allowed = [];
            foreach ($tmp_groups[$i]['adminpages'] as $page) {
                if (in_array($page['id'], $permission))
                    $allowed[] = $page;
            }
            if ($allowed) {
                $tmp_groups[$i]['adminpages'] = $allowed;
                $groups[] = $tmp_groups[$i];
            }
        }
        return $groups;
    }
    static function get_display_pages_in_group()
    {
        $groups = [];
        $tmp_groups = self::get_allowed_pages_in_group();
        for ($i = 0; $i < count($tmp_groups); $i++) {
            $allowed = [];
            foreach ($tmp_groups[$i]['admin_pages'] as $page) {
                if ($page['page_status'] && $page['page_can_display'])
                $allowed[] = $page;
            }
            if ($allowed) {
                $tmp_groups[$i]['admin_pages'] = $allowed;
                $groups[] = $tmp_groups[$i];
            }
        }
        return $groups;
    }

    function ui_view_pages()
    {
        $data = [];
        return view('Spider::Admin.AdminPage.view_pages', $data);
    }
    function ui_create_page()
    {
        $data = [];
        return view('Spider::Admin.AdminPage.create_page', $data);
    }
    function ui_edit_page()
    {
        $data = [];
        return view('Spider::Admin.AdminPage.edit_page', $data);
    }
    function ui_view_groups()
    {
        $data = [];
        return view('Spider::Admin.AdminPage.view_groups', $data);
    }
    function ui_create_group()
    {
        $data = [];
        return view('Spider::Admin.AdminPage.create_group', $data);
    }
    function ui_edit_group()
    {
        $data = [];
        return view('Spider::Admin.AdminPage.edit_group', $data);
    }

    function web_create_page(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_page($params);
        return self::web_response($result);
    }
    function web_edit_page(Request $request, $pageId)
    {
        // To-Do
        $params = null;
        $result = self::edit_page($pageId, $params);
        return self::web_response($result);
    }
    function web_create_group(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_group($params);
        return self::web_response($result);
    }
    function web_edit_group(Request $request, $groupId)
    {
        // To-Do
        $params = null;
        $result = self::edit_group($groupId, $params);
        return self::web_response($result);
    }

    function api_create_page(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_page($params);
        return self::api_response($result);
    }
    function api_edit_page(Request $request, $pageId)
    {
        // To-Do
        $params = null;
        $result = self::edit_page($pageId, $params);
        return self::api_response($result);
    }
    function api_toggle_page_status(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::toggle_page_status($params);
        return self::api_response($result);
    }
    function api_create_group(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_group($params);
        return self::api_response($result);
    }
    function api_edit_group(Request $request, $groupId)
    {
        // To-Do
        $params = null;
        $result = self::edit_group($groupId, $params);
        return self::api_response($result);
    }

    private function create_page($params)
    {
        $page = new AdminPage();
        return ["success" => $page->save()];
    }
    private function edit_page($pageId, $params)
    {
        $page = AdminPage::find($pageId);
        return ["success" => $page->save()];
    }
    private function toggle_page_status($pageId)
    {
        $page = AdminPage::find($pageId);
        return ["success" => $page->save()];
    }
    private function create_group($params)
    {
        $group = new AdminPageGroup();
        return ["success" => $group->save()];
    }
    private function edit_group($groupId, $params)
    {
        $group = AdminPageGroup::find($groupId);
        return ["success" => $group->save()];
    }
}
