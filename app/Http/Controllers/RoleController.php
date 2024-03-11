<?php

namespace App\Http\Controllers;

use App\Contracts\ModuleInterface;
use App\Contracts\RoleInterface;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
  

     public $role;
     public $module;
     public function __construct(RoleInterface $interface = null, ModuleInterface $moduleInterface) {
        $this->role = $interface;
        $this->module = $moduleInterface;
     }

   

    public function index()
    {
        Gate::authorize('role.index');
        $roles = $this->role->all();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 

        Gate::authorize('role.create');
        $modules = $this->module->all(); 
        return view('backend.role.form', compact('modules'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {  
        Gate::authorize('role.create');
        $this->role->create($request);
        notify()->success('Role Create Successfully', 'Success');
        return redirect('admin/roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('role.edit');
        $modules = $this->module->all(); 
        return view('backend.role.form', compact('modules','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    { 
        Gate::authorize('role.edit');

        $this->validate($request,[
            'name'  => 'required | max:30',
        ]);
        $this->role->update($request,$role);
        notify()->success('Update Successfully','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role->deletable==false){
            notify()->error('Role not Deletable', 'Error');
        }else{
            $role->delete();
            notify()->error('Delete Successfully','Deleted');
        }
        return back();
    }
}
