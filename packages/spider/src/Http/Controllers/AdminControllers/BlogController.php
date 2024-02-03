<?php

namespace Vector\Spider\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use Vector\Spider\database\Models\Blog;
use Vector\Spider\database\Models\BlogCategory;
use Vector\Spider\Http\Controllers\BaseControllers\BlogBase;

class BlogController extends BlogBase
{
    function ui_view_blogs()
    {
        $data = [];
        return view('', $data);
    }
    function ui_create_blog()
    {
        $data = [];
        return view('', $data);
    }
    function ui_edit_blog()
    {
        $data = [];
        return view('', $data);
    }
    function ui_view_categories()
    {
        $data = [];
        return view('', $data);
    }
    function ui_create_category()
    {
        $data = [];
        return view('', $data);
    }
    function ui_edit_category()
    {
        $data = [];
        return view('', $data);
    }

    function web_create_blog(Request $request)
    {
        $params = null;
        $result = self::create_blog($params);
        return self::web_response($result);
    }
    function web_edit_blog(Request $request, $blogId)
    {
        $params = null;
        $result = self::edit_blog($blogId, $params);
        return self::web_response($result);
    }
    function web_create_category(Request $request)
    {
        $params = null;
        $result = self::create_category($params);
        return self::web_response($result);
    }
    function web_edit_category(Request $request, $catId)
    {
        $params = null;
        $result = self::edit_category($catId, $params);
        return self::web_response($result);
    }

    function api_create_blog(Request $request)
    {
        $params = null;
        $result = self::create_blog($params);
        return self::api_response($result);
    }
    function api_edit_blog(Request $request, $blogId)
    {
        $params = null;
        $result = self::edit_blog($blogId, $params);
        return self::api_response($result);
    }
    function api_toggle_blog_status(Request $request, $blogId)
    {
        $params = null;
        $result = self::toggle_blog_status($blogId, $params);
        return self::api_response($result);
    }
    function api_create_category(Request $request)
    {
        $params = null;
        $result = self::create_category($params);
        return self::api_response($result);
    }
    function api_edit_category(Request $request, $catId)
    {
        $params = null;
        $result = self::edit_category($catId, $params);
        return self::api_response($result);
    }

    private function create_blog($params)
    {
        $group = new Blog();
        return ["success" => $group->save()];
    }
    private function edit_blog($blogId, $params)
    {
        $group = Blog::find($blogId);
        return ["success" => $group->save()];
    }
    private function toggle_blog_status($blogId, $params)
    {
        $group = Blog::find($blogId);
        return ["success" => $group->save()];
    }
    private function create_category($params)
    {
        $group = new BlogCategory();
        return ["success" => $group->save()];
    }
    private function edit_category($catId, $params)
    {
        $group = BlogCategory::find($catId);
        return ["success" => $group->save()];
    }
}
