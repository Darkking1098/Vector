<?php

namespace Vector\Spider\Http\Controllers\AdminControllers;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Vector\Spider\database\Models\AdminRole;
use Vector\Spider\database\Models\Employee;
use Vector\Spider\Http\Controllers\Controller;
use Vector\Spider\Http\Security\JWT;

class EmployeeController extends Controller
{
    function get_allemps()
    {
        return Employee::with('admin_role')->get()->toArray();
    }
    function get_empById($empId)
    {
        $emp = Employee::with('admin_role')->find($empId);
        return $emp->toArray();
    }
    function get_empByUsername($empUsername)
    {
        return Employee::where('emp_username', $empUsername)->with('admin_role')->first()->toArray();
    }
    function get_self()
    {
        return self::get_empById(session()->get('adminId'));
    }
    function get_permitted_pages()
    {
        $role = self::get_self()['admin_role'];
        return $role['role_permissions'];
    }

    function ui_login()
    {
        return session()->has('adminId') ? redirect()->route('admin_home') : view('Spider::Admin.login');
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
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $params = [
            "username" => $request->username,
            "password" => $request->password,
        ];
        $result = self::login($params);
        if ($result['success']) {
            session()->put("adminId", $result['adminId']);
            return redirect()->route('admin_home');
        }
        return self::web_response($result);
    }
    function web_logout(Request $request)
    {
        self::logout();
        return redirect()->route('admin_login');
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
        $employee = Employee::where('emp_username', $params['username'])->first();
        if ($employee) {
            $ed = $employee->getOriginal();
            if (!$ed['emp_status']) {
                return ["success" => false, "msg" => "Contact HR"];
            } else if ($ed['emp_password'] == $params['password']) {
                $jwt = JWT::generate(["adminId" => $ed['id']], false);
                Cookie::queue('jwt', $jwt);
                return ["success" => true, "adminId" => $ed['id']];
            }
        }
        return ["success" => false, "msg" => "Invalid Credentials"];
    }
    private function logout()
    {
        return ['success' => session()->flush()];
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
