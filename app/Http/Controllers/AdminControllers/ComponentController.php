<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Component;
use Illuminate\Http\Request;
use Vector\Spider\Http\Controllers\AdminControllers\SEOController;
use Vector\Spider\Http\Controllers\Controller;

class ComponentController extends Controller
{
    function ui_view_components()
    {
        $data = ["components" => Component::withCount('varients')->get()->toArray()];
        return view('admin.components.view_components', $data);
    }
    function ui_view_component($compId)
    {
        $component = Component::with('varients')->find($compId);
        return view('admin.components.view_component', ['component' => $component ? $component->toArray() : []]);
    }
    function ui_create_component()
    {
        $data = ["components" => Component::get(['id', 'component_title'])->toArray()];
        return view('admin.components.create_component', $data);
    }
    function web_create_component(Request $request)
    {
        return self::web_response(self::create_component([
            "component_title" => $request->component_title,
            "component_class" => $request->component_class,
            "component_desc" => $request->component_desc,
            "component_html" => $request->component_html,
            "component_css" => $request->component_css,
            "component_js" => $request->component_js
        ]));
    }
    function create_component($params)
    {
        $page = SEOController::add_webpage([
            "webpage_slug" => "components/" . str_replace(" ", "_", strtolower($params['component_title']))
        ]);
        if (!$page['success'])
            return ["success" => false, "msg" => "Webpage not created"];
        $component = new Component($params + ["slug_id" => $page['webpage_id']]);
        return ["success" => $component->save()];
    }
}
