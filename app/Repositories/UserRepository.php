<?php
namespace App\Repositories;

use App\Model\User;

class UserRepository 
{
    public function create($userData)
    {
        $user              = new User();
        $user->name        = $userData->name;
        $user->email       = $userData->email;
        $user->password    = bcrypt($userData->password);
        $user->save();

        return $user;
    }
}