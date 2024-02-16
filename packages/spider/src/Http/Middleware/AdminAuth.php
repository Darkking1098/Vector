<?php

namespace Vector\Spider\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Vector\Spider\Http\Controllers\AdminControllers\EmployeeController;
use Vector\Spider\Models\AdminPage;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);

        /** Redirecting to login if user is not logged in */
        if (!session()->has("adminId"))
            return redirect()->route("admin_login");

        /** Getting Employee data */
        $empCon = new EmployeeController;
        $admin = $empCon->get_self();

        /** Redirecting to logout if user  is disabled */
        if (!$admin['emp_status'])
            return $empCon::web_response(['msg' => "Contact HR"]);

        /** Path of current request */
        $path = $request->path();
        $page = ["current_slug" => "", "current_url" => "admin"];

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

            /** Get Pages allowed to current user */
            $permissions = $empCon->get_permitted_pages();

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
