<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Version\VersionCollection;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    function index()
    {
        if ($this->user->tokenCan("1")) {
            $data = [[
                'color' => 'orange',
                'type' => 'fruit',
                'remain' => 6,
            ]];

            return response(new VersionCollection($data));
        } else {
            return response(["message" => "no permission"]);
        }
    }
}
