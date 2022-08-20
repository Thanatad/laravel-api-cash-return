<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Version\VersionCollection;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    function index()
    {
        $data = [[
            'color' => 'orange',
            'type' => 'fruit',
            'remain' => 6,
        ]];

        return response(new VersionCollection($data));
    }
}
