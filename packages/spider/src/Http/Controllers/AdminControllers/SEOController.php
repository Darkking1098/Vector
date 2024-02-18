<?php

namespace Vector\Spider\Http\Controllers\AdminControllers;

use Illuminate\Http\Client\Request;
use Vector\Spider\Models\WebImage;
use Vector\Spider\Models\WebPage;
use Vector\Spider\Http\Controllers\BaseControllers\SEOBase;

class SEOController extends SEOBase
{
    function ui_view_webpages()
    {
        $data = [];
        return view('', $data);
    }
    function ui_add_webpage()
    {
        $data = [];
        return view('', $data);
    }
    function ui_edit_webpage()
    {
        $data = [];
        return view('', $data);
    }
    function ui_view_webimages()
    {
        $data = [];
        return view('', $data);
    }
    function ui_upload_webimages()
    {
        $data = [];
        return view('', $data);
    }
    function ui_edit_webimage()
    {
        $data = [];
        return view('', $data);
    }

    function web_add_webpage(Request $request)
    {
        $params = null;
        $result = self::add_webpage($params);
        self::web_response($result);
    }
    function web_edit_webpage(Request $request, $webpageId)
    {
        $params = null;
        $result = self::edit_webpage($webpageId, $params);
        self::web_response($result);
    }
    function web_upload_webimages(Request $request)
    {
        $params = null;
        $result = self::upload_webimages($params);
        self::web_response($result);
    }
    function web_edit_webimage(Request $request, $webimageId)
    {
        $params = null;
        $result = self::edit_webimage($webimageId, $params);
        self::web_response($result);
    }

    function api_add_webpage($params)
    {
        self::api_response(self::add_webpage($params));
    }
    function api_edit_webpage(Request $request, $webpageId)
    {
        $params = null;
        $result = self::edit_webpage($webpageId, $params);
        self::api_response($result);
    }
    function api_toggle_webpage_status(Request $request, $webpageId)
    {
        $params = null;
        $result = self::toggle_webpage_status($webpageId, $params);
        self::api_response($result);
    }
    function api_upload_webimages(Request $request)
    {
        $params = null;
        $result = self::upload_webimages($params);
        self::api_response($result);
    }
    function api_edit_webimage(Request $request, $webimageId)
    {
        $params = null;
        $result = self::edit_webimage($webimageId, $params);
        self::api_response($result);
    }

    static function add_webpage($params)
    {
        $webpage = new WebPage($params);
        return ["success" => $webpage->save(), 'webpage_id' => $webpage->id];
    }
    static function edit_webpage($webpageId, $params)
    {
        $webpage = WebPage::find($webpageId);
        return ["success" => $webpage->save()];
    }
    static function toggle_webpage_status($webpageId, $params)
    {
        $webpage = WebPage::find($webpageId);
        return ["success" => $webpage->save()];
    }
    static function upload_webimages($params)
    {
        $webimageId = new WebImage();
        return ["success" => $webimageId->save()];
    }
    static function edit_webimage($webimageId, $params)
    {
        $webimageId = WebImage::find($webimageId);
        return ["success" => $webimageId->save()];
    }
}
