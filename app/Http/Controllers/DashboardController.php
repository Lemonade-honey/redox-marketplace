<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $inspire = \Illuminate\Foundation\Inspiring::quote();
        return view('dashboard.dashboard', [
            'quote' => $inspire
        ]);
    }
}
