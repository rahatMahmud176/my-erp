<?php 
 
namespace App\Repositories;
 
use App\Contracts\SizeInterface;
use App\Models\Backend\Size;

class SizeRepository implements SizeInterface
{

    public function all()
    {
        return Size::all();
    }
    public function store($request)
    {
        Size::newSize($request);
    }
    public function update($request,$size)
    {
        Size::sizeUpdate($request,$size);
    }

    
}