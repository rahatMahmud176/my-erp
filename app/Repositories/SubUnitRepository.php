<?php 
 
namespace App\Repositories;
 
use App\Contracts\SubUnitInterface;
use App\Models\Backend\SubUnit;

class SubUnitRepository implements SubUnitInterface
{

    public function all()
    {
        return SubUnit::all();
    }
    public function store($request)
    {
        SubUnit::newSubUnit($request);
    }
    public function update($request,$subUnit)
    {
        SubUnit::subUnitUpdate($request,$subUnit);
    }

    
}