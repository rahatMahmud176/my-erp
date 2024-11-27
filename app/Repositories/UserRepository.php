<?php
namespace App\Repositories;

use App\Contracts\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function update($user,$request)
    {
        $user->update([
            'role_id'   => $request->role,
            'branch_id' => $request->branch,
    ]);
    }
}
