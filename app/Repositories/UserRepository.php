<?php
namespace App\Repositories;

use App\Contracts\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function update($user,$request)
    {
        User::updateUser($user,$request);
    }
}