<?php 
 
namespace App\Repositories;
 
use App\Contracts\SubUnitInterface;
use App\Models\Backend\SubUnit;

class SubUnitRepository implements SubUnitInterface
{

    public function all()
    {
        return SubUnit::orderBy('id','desc')->get();
    }
    public function store($request)
    {
        SubUnit::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$subUnit)
    {
        $subUnit->update([
            'name'  => $request->name,
        ]);
    }

    
}