<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\BrandInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\CountryVariantInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Item;
use Illuminate\Http\Request;
use App\Contracts\ItemInterface;
use App\Contracts\subCategoryInterface;
use App\Contracts\SubUnitInterface;
use App\Contracts\UnitInterface;

class ItemController extends Controller
{
     
    public $items;
    public $countries;
    public $categories;
    public $subCats;
    public $brands;
    public $units;
    public $subUnits;

    public function __construct(ItemInterface $itemInterface, 
                                CategoryInterface $categories,
                                subCategoryInterface $subCats,
                                BrandInterface $brands,
                                UnitInterface $units,
                                SubUnitInterface $subUnits,
                                CountryVariantInterface $countries,
                                
                                ) {
        $this->items = $itemInterface;
        $this->countries = $countries;
        $this->categories = $categories;
        $this->subCats = $subCats;
        $this->brands = $brands;
        $this->units = $units;
        $this->subUnits = $subUnits;
    }


    public function index()
    {
        $items =  $this->items->all(); 
        return view('backend.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->countries->all();
        $categories = $this->categories->all(); 
        $subCats = $this->subCats->all();
        $brands = $this->brands->all();
        $units = $this->units->all();
        $subUnits = $this->subUnits->all();

           return view('backend.item.form', compact('countries','categories','subCats','brands','units','subUnits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Item::newItem($request);
        notify('Save Successfully','Saved');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $countries = $this->countries->all();
        $categories = $this->categories->all(); 
        $subCats = $this->subCats->all();
        $brands = $this->brands->all();
        $units = $this->units->all();
        $subUnits = $this->subUnits->all();

           return view('backend.item.form', compact('item','countries','categories','subCats','brands','units','subUnits'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    { 
        Item::updateItem($request,$item);
        notify('Updated Successfully','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
