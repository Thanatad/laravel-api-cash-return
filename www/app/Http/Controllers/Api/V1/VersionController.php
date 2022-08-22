<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Version\VersionCollection;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index', 'show']]);
    }

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
