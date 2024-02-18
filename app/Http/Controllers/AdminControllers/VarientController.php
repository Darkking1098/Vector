<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;

class VarientController extends Controller
{
    function ui_init_varient($compId)
    {
        $comp = Component::withCount('varients')->find($compId);
        if (!$comp) abort(404);
        $data = ["component" => $comp->toArray()];
        return view('admin.varients.init_varient', $data);
    }
    function ui_modify_varient(){
        return view('admin.varients.modify_varient');
    }
}
