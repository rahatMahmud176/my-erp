<?php 
 
namespace App\Repositories;
 
use App\Contracts\SizeInterface;
use App\Models\Backend\Size;

class SizeRepository implements SizeInterface
{

    public function all()
    {
        return Size::orderBy('id','DESC')->paginate(10);
    }
    public function store($request)
    {
        Size::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$size)
    {
        $size->update([
            'name'  => $request->name,
        ]);
    }

    
}