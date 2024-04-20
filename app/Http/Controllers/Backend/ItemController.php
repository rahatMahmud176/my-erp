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
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('item.index');

        $items =  $this->items->all(); 
        return view('backend.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('item.create');

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
        Gate::authorize('item.create');
       $this->infoValidate($request);

        $this->items->newItem($request);
        notify('Save Successfully','Saved');
        return back();
    }

    public function infoValidate($request)
    {
        $this->validate($request,[
            'name'  => 'required',
            'cats'  => 'required',
            'sub_cats'  => 'required',
            'brand'  => 'required',
            'unit'  => 'required',
            'sub_unit'  => 'required',
            'countries'  => 'required',
        ],[
            'cats.required' => 'Category field is required',
            'sub_cats.required' => 'Category field is required',
        ]);
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
        Gate::authorize('item.edit');
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
        Gate::authorize('item.edit');
        // return $item;
       $this->infoValidate($request);

       $this->items->updateItem($request,$item);
        notify('Updated Successfully','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    { 
        Gate::authorize('item.delete');
        $item->delete();
        notify()->success('delete Successfully','Success'); 
        return back();
    }
}
