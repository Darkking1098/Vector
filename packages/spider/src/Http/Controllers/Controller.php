<?php

namespace Vector\Spider\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Str;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Setting default location to store files
    private $file_path;
    protected const API_LIMIT = 25;

    // Constructor to initialize the property
    public function __construct()
    {
        // Set the value of $file_path in the constructor
        $this->file_path = public_path('images');
    }

    // Move Files to a particular location
    function move_file($file, $path = null)
    {
        // Create Directory if not exists
        if (!is_dir($x = $path ?? $this->file_path)) mkdir($x, 0777, true);

        // Rename file to new name
        $img = Str::random(5) . time() . '.' . $file->getClientOriginalExtension();

        // Returning new filename with action status
        return [
            "success" => $file->move($path ?? $this->file_path, $img),
            "filename" => $img
        ];
    }

    // Use to send web response
    static function web_response($result)
    {
        session()->flash('result', $result);
        return redirect()->back();
    }

    // Use to send api response with some default data
    static function api_response($result)
    {
        return response()->json($result + ["timestamp" => time()]);
    }

    // Table Response
    static function table_response($data, $model)
    {
        $data['total_entries'] = $model::count();
        $data['page_limit'] = request()->limit ?? self::API_LIMIT;
        $data['total_pages'] = intval(ceil($data['total_entries'] / $data['page_limit']));
        $from = request()->fetched_from ?? 1;
        $data['fetched_from'] = $from > 0 ? $from : 0;
        $data['current_page'] = intval(ceil($data['fetched_from'] / $data['page_limit']))+1;
        $data['has_more'] = $data['total_entries'] > $data['fetched_from'] + $data['page_limit'];

        return self::api_response($data);
    }
}
