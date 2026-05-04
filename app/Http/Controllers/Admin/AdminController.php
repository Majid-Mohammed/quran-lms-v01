<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    { 
        
        $menuItems=[];
        return view('/admin.dashboard', compact('menuItems'));
        // return redirect()->route('admin.dashboard', compact('menuItems'));
        
    }
}
