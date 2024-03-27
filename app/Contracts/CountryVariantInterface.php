<?php 

namespace App\Contracts;

interface CountryVariantInterface 
{
    public function all();
    public function store($request);
    public function update($request,$countryVariant);
}