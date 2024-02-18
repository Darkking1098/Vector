<?php

namespace Vector\Spider\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Vector\Spider\Http\Controllers\AdminControllers\EmployeeController;
use Vector\Spider\Http\Controllers\Controller;
use Vector\Spider\Models\AdminPage;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        /** Redirecting to login if user is not logged in */
        if (!session()->has("adminId"))
            return redirect()->route("admin_login");

        /** Getting Employee data */
        $admin = EmployeeController::get_self();

        /** Redirecting to logout if user  is disabled */
        if (!$admin['emp_status'])
            return Controller::web_response(['msg' => "Contact HR"]);

        /** Path of current request */
        $path = $request->path();
        $page = ["current_slug" => "", "current_url" => "admin", 'page_title'=>"Dashboard"];

        if (strpos($path, "/") !== false) {
            /** Checking if last is numeric (remove if true) */
            if (is_numeric(substr($path, -1, 1))) {
                $slug = substr($path, 0, strrpos($path, "/"));
            }
            $page["current_url"] = $slug ?? $path;

            /** It should be admin/slug. So remove admin */
            $slug = substr($page["current_url"], strpos($page["current_url"], "/") + 1);
            $page["current_slug"] = $slug;

            /** Getting page data */
            $pg = AdminPage::with('admin_page_group')->where("page_url", $slug)->first();
            if (!$pg) abort(404);
            $page["page_group"] = $pg->page_group_id;
            $page['page_title'] = $pg->page_title;
            /** Get Pages allowed to current user */
            $permissions = $admin['admin_role']['role_permissions'];

            /** Checking if page is not disable Or permitted */
            if (!($pg->page_status && (in_array($pg->id, $permissions) || $permissions[0] == '*'))) {
                return redirect()->route('admin_home');
            }
        }

        /** Sharing data to views */
        View::share(['admin' => $admin, "current" => $page]);
        return $next($request);
    }
}
