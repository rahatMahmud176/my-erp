<?php 
 
namespace App\Repositories;
 
use App\Contracts\UnitInterface;
use App\Models\Backend\Unit;

class UnitRepository implements UnitInterface
{

    public function all()
    {
        return Unit::all();
    }
    public function store($request)
    {
        Unit::newUnit($request);
    }
    public function update($request,$unit)
    {
        Unit::unitUpdate($request,$unit);
    }

    
}