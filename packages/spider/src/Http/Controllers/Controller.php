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
        $img = Str::random(5) . now()->timestamp . '.' . $file->getClientOriginalExtension();

        // Returning new filename with action status
        return [
            "success" => $file->move($path ?? $this->file_path, $img),
            "filename" => $img
        ];
    }

    // Use to send web response
    function web_response($result)
    {
        session()->flash('result', $result);
        return redirect()->back();
    }

    // Use to send api response with some default data
    function api_response($result)
    {
        return response()->json($result + ["timestamp" => now()->timestamp]);
    }
}
