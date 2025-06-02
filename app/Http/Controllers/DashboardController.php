<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $recentInformations = Information::whereDate('created_at', '>=', now()->subDays(1))->latest()->get();

        return view('dashboard', compact('recentInformations'));
    }
}
