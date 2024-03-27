<?php 
 
namespace App\Repositories;
 
use App\Contracts\CountryVariantInterface;
use App\Models\Backend\CountryVariant;

class CountryVariantRepository implements CountryVariantInterface
{

    public function all()
    {
        return CountryVariant::all();
    }
    public function store($request)
    {
        CountryVariant::newCountryVariant($request);
    }
    public function update($request,$countryVariant)
    {
        CountryVariant::countryVariantUpdate($request,$countryVariant);
    }

    
}