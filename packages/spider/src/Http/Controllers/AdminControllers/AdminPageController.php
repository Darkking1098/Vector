<?php

namespace Vector\Spider\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use Vector\Spider\Http\controllers\Controller;
use Vector\Spider\Models\AdminPage;
use Vector\Spider\Models\AdminPageGroup;

class AdminPageController extends Controller
{
    static function get_groups()
    {
        return AdminPageGroup::withCount('admin_pages')->get()->toArray();
    }
    static function get_groupById($groupId)
    {
        return AdminPageGroup::with('admin_pages')->find($groupId);
    }
    static function get_groupsWithPages()
    {
        return AdminPageGroup::with(['admin_pages' => function ($query) {
            $query->where('page_status', 1)->where('page_can_display', 1);
        }])->orderBy('page_group_index')->get()->toArray();
    }
    static function get_groupsWithAllPages()
    {
        return AdminPageGroup::with('admin_pages')->orderBy('page_group_index')->get()->toArray();
    }
    static function get_groupsWithActivePages()
    {
        return AdminPageGroup::with(['admin_pages' => function ($query) {
            $query->where('page_status', 1);
        }])->orderBy('page_group_index')->get()->toArray();
    }
    static function get_pages()
    {
        return AdminPage::all()->toArray();
    }
    static function get_pageById($pageId)
    {
        return AdminPage::with('admin_page_group')->find($pageId);
    }
    static function get_allowedPages()
    {
        $groups = [];
        $temp_pages = self::get_groupsWithPages();
        $permitted = EmployeeController::get_self()['admin_role']['role_permissions'];
        if ($permitted[0] == "*") return $temp_pages;
        for ($i = 0; $i < count($temp_pages); $i++) {
            $allowed = [];
            foreach ($temp_pages[$i]['admin_pages'] as $page) {
                if (in_array($page['id'], $permitted)) $allowed[] = $page;
            }
            if ($allowed) {
                $temp_pages[$i]['admin_pages'] = $allowed;
                $groups[] = $temp_pages[$i];
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

    function api_view_pages(Request $request)
    {
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
