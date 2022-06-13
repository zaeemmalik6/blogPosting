<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NormalUserController extends Controller
{
    public function index()
    {
        return view('normalUserDashboard');
    }
}
