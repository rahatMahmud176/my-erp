<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\RoleInterface;
use App\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public $role;
   public $user;

    public function __construct(RoleInterface $roleInterface, UserInterface $userInterface) {
        $this->role = $roleInterface;
        $this->user = $userInterface;
    }






    public function index()
    { 

        $users = User::all();
        return view('backend.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = $user;
        $roles = $this->role->all();
        return view('backend.users.form', compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->user->update($user,$request);
        notify()->success('User Role Updated','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user;
    }
}
