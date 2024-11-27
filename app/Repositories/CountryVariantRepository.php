<?php 
 
namespace App\Repositories;
 
use App\Contracts\CountryVariantInterface;
use App\Models\Backend\CountryVariant;

class CountryVariantRepository implements CountryVariantInterface
{

    public function all()
    {
        return CountryVariant::orderBy('id','DESC')->paginate(10);
    }
    public function store($request)
    {
        CountryVariant::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$countryVariant)
    {
        $countryVariant->update([
            'name'  => $request->name,
        ]);
    }

    
}