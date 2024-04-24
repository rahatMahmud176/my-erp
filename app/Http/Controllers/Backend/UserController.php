<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\BranchInterface;
use App\Contracts\RoleInterface;
use App\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
   public $role;
   public $user;
   public $branches;

    public function __construct(RoleInterface $roleInterface, 
                                UserInterface $userInterface, 
                                BranchInterface $branchInterface) {
        $this->role     = $roleInterface;
        $this->user     = $userInterface;
        $this->branches = $branchInterface;
    }






    public function index()
    { 

        Gate::authorize('user.index');

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
        Gate::authorize('user.edit');

        $user     = $user;
        $roles    = $this->role->all();
        $branches = $this->branches->all();
        return view('backend.users.form', compact('user','roles','branches'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('user.edit');

        

        $this->user->update($user,$request);
        notify()->success('User Role Updated','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('user.delete'); 
        return $user;
    }
}
