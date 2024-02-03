<?php

namespace Vector\Spider\Http\Controllers\AdminControllers;

use Illuminate\Http\Client\Request;
use Vector\Spider\database\Models\AdminRole;
use Vector\Spider\database\Models\Employee;
use Vector\Spider\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    function ui_login()
    {
        $data = [];
        return view('', $data);
    }
    function ui_view_emps()
    {
        $data = [];
        return view('', $data);
    }
    function ui_create_emp()
    {
        $data = [];
        return view('', $data);
    }
    function ui_edit_emp()
    {
        $data = [];
        return view('', $data);
    }
    function ui_view_roles()
    {
        $data = [];
        return view('', $data);
    }
    function ui_create_role()
    {
        $data = [];
        return view('', $data);
    }
    function ui_edit_role()
    {
        $data = [];
        return view('', $data);
    }

    function web_login(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::login($params);
        return self::web_response($result);
    }
    function web_logout(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::logout($params);
        return self::web_response($result);
    }
    function web_toggle_status(Request $request, $empId)
    {
        // To-Do
        $result = self::toggle_status($empId);
        return self::web_response($result);
    }
    function web_create_emp(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_emp($params);
        return self::web_response($result);
    }
    function web_edit_emp(Request $request, $empId)
    {
        // To-Do
        $params = null;
        $result = self::edit_emp($empId, $params);
        return self::web_response($result);
    }
    function web_create_role(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_role($params);
        return self::web_response($result);
    }
    function web_edit_role(Request $request, $roleId)
    {
        // To-Do
        $params = null;
        $result = self::edit_role($roleId, $params);
        return self::web_response($result);
    }

    function api_login(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::login($params);
        return self::api_response($result);
    }
    function api_logout(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::logout($params);
        return self::api_response($result);
    }
    function api_toggle_status(Request $request, $empId)
    {
        // To-Do
        $result = self::toggle_status($empId);
        return self::api_response($result);
    }
    function api_create_emp(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_emp($params);
        return self::api_response($result);
    }
    function api_edit_emp(Request $request, $empId)
    {
        // To-Do
        $params = null;
        $result = self::edit_emp($empId, $params);
        return self::api_response($result);
    }
    function api_create_role(Request $request)
    {
        // To-Do
        $params = null;
        $result = self::create_role($params);
        return self::api_response($result);
    }
    function api_edit_role(Request $request, $roleId)
    {
        // To-Do
        $params = null;
        $result = self::edit_role($roleId, $params);
        return self::api_response($result);
    }

    private function login($params)
    {
        $employee = null;
        return ["success" => $employee];
    }
    private function logout($empId)
    {
        return ["success" => session()->forget([])];
    }
    private function create_emp($params)
    {
        $employee = new Employee();
        return ["success" => $employee->save()];
    }
    private function edit_emp($empId, $params)
    {
        $employee = Employee::find($empId);
        return ["success" => $employee->save()];
    }
    private function toggle_status($empId)
    {
        $employee = Employee::find($empId);
        return ["success" => $employee->save()];
    }
    private function create_role($params)
    {
        $role = new AdminRole();
        return ["success" => $role->save()];
    }
    private function edit_role($roleId, $params)
    {
        $role = AdminRole::find($roleId);
        return ["success" => $role->save()];
    }
}
