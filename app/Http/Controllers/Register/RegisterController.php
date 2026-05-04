<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        
        $menuItems = [];
        return view('register.dashboard', compact('menuItems'));
    }
}
