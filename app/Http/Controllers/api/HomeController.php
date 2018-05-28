<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        return response()->json([
           'inspiration' => Inspiring::quote(),
           'heartBeat' => number_format((microtime(true) - LARAVEL_START) * 1000, 2) . ' ms'
        ]);
    }
}
