<?php 
 
namespace App\Repositories;
 
use App\Contracts\UnitInterface;
use App\Models\Backend\Unit;

class UnitRepository implements UnitInterface
{

    public function all()
    {
        return Unit::orderBy('id','desc')->paginate(10);
    }
    public function store($request)
    {
        Unit::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$unit)
    {
        $unit->update([
            'name'  => $request->name,
        ]);
    }

    
}