<?php 
 
namespace App\Repositories;
 
use App\Contracts\ColorInterface;
use App\Models\Backend\Color;

class ColorRepository implements ColorInterface
{

    public function all()
    {
        return Color::orderBy('id','DESC')->paginate(10);
    }
    public function store($request)
    {
        Color::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$color)
    {
        $color->update([
            'name'  => $request->name,
        ]);
    }

    
}