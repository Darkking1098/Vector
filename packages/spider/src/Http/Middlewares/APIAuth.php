<?php

namespace Vector\Spider\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Vector\Spider\database\Models\AdminPage;
use Vector\Spider\Http\Controllers\AdminControllers\EmployeeController;
use Vector\Spider\Http\Controllers\Controller;
use Vector\Spider\Http\Security\JWT;

class APIAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $jwt = JWT::validate($request->cookie('jwt'));
        if (!$jwt['success']) return Controller::api_response($jwt);

        if (isset($jwt['data']['adminId'])) {
            $empCon = new EmployeeController;
            $admin = $empCon->get_empById($jwt['data']['adminId']);

            /** Redirecting to logout if user  is disabled */
            if (!$admin['emp_status']) return Controller::api_response(['success' => false, "msg" => "Contect HR"]);
        } else if (isset($jwt['APIToken'])) {
            // Not Working Yet
        } else {
            return Controller::api_response(['success' => false, "msg" => "Something went wrong..."]);
        }

        /** Path of current request */
        $path = $request->path();
        if ($path != "api/admin") {
            /** Checking if last is numeric (remove if true) */
            if (is_numeric(substr($path, -1, 1))) {
                $slug = substr($path, 0, strrpos($path, "/"));
            }
            $page["current_url"] = $slug ?? $path;

            /** It should be api/admin/slug. So remove api/admin */
            $slug = substr($page["current_url"], strpos($page["current_url"], "/", 5) + 1);

            /** Getting page data */
            $pg = AdminPage::with('admin_page_group')->where("page_url", $slug)->first();
            if (!$pg) return Controller::api_response(['success' => false, "msg" => "Target Endpoint does not exist."]);

            /** Get Pages allowed to current user */
            $permissions = $empCon->get_permitted_pages();

            /** Checking if page is not disable Or permitted */
            if (!($pg->page_status && (in_array($pg->id, $permissions) || $permissions[0] == '*'))) {
                return Controller::api_response(['success' => false, "msg" => "Buddy, you are lost..."]);
            }
        }

        return $next($request);
    }
}
