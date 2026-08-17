<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('psikolog.dashboard');
    }
}
