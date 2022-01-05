<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
      $user = Auth::guard('admin')->user();
      return view('admin.dashboard', ['user' => $user]);
    }




}
