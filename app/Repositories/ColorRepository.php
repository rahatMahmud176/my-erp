<?php 
 
namespace App\Repositories;
 
use App\Contracts\ColorInterface;
use App\Models\Backend\Color;

class ColorRepository implements ColorInterface
{

    public function all()
    {
        return Color::all();
    }
    public function store($request)
    {
        Color::newColor($request);
    }
    public function update($request,$color)
    {
        Color::colorUpdate($request,$color);
    }

    
}