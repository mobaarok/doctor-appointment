<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class AdminRepository
{
    public function adminInfo()
    {
        $admin = Auth::guard('admin')->user();
        return $admin;
    }
}
