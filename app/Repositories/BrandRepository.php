<?php 
 
namespace App\Repositories;

use App\Contracts\BrandInterface;
use App\Models\Backend\Brand;

class BrandRepository implements BrandInterface
{

    public function all()
    {
        return Brand::all();
    }
    public function store($request)
    {
        Brand::newBrand($request);
    }
    public function update($request,$category)
    {
        Brand::brandUpdate($request,$category);
    }

    
}