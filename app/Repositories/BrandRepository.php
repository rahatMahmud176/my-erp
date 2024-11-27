<?php 
 
namespace App\Repositories;

use App\Contracts\BrandInterface;
use App\Models\Backend\Brand;

class BrandRepository implements BrandInterface
{

    public function all()
    {
        return Brand::orderBy('id','DESC')->paginate(10);
    }
    public function store($request)
    {
        Brand::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$brand)
    {
        $brand->update([
            'name'  => $request->name,
        ]);
    }

    
}