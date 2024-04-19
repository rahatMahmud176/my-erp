@extends('backend.master')
@section('title')
    Item @isset($item) Edit @else Add @endisset   
@endsection
@section('content')
    <div class="row">
        <div class="card text-left"> 
          <div class="card-body">
             
            <div class="mt-3 clearfix">
                <h3 class="float-start">#Item @isset($item) Edit @else Add @endisset </h3>
                <a href="{{ route('admin.items.index') }}" class="btn btn-sm btn-danger  float-end">
                     Cancel</a>
            </div>

            <div class="row">
                
                    <form class="row" action=" @isset($item) {{ route('admin.items.update',$item->id) }} @else {{ route('admin.items.store') }} @endisset" method="post">
                        @csrf
                        @isset($item)
                          @method('PUT')
                        @endisset

                        <div class="form-group col-md-6 my-3">
                          <label for="">Item Name </label>
                          <input type="text" name="name" id="" class="form-control" value="@isset($item) {{ $item->name }} @endisset  ">
                         </div>

                        <div class="form-group col-md-6 my-3">   </div>

                      <div class="form-group col-md-6 my-3"> 
                        <h5 for="">  <i class="bi bi-arrow-right-short"></i>Category</h5>
                             <div class="form-check"> 
                            @foreach ($categories as $cat)
                                
                           
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="cats[]" id="" value="{{ $cat->id }}" @isset($item) @foreach($item->categories as $category) {{ $category->id == $cat->id ?'checked':'' }} @endforeach @else {{ $loop->index==0?'checked':'' }}  @endisset >
                                    {{ $cat->name }}
                                </label>
                                <br>
                               @endforeach
                             </div>
                        </div>


                      <div class="form-group col-md-6 my-3"> 
                       
                             <h5 for="">  <i class="bi bi-arrow-right-short"></i> Sub Category</h5>
                             <div class="form-check"> 

                              @foreach ($subCats as $cat)
                                
                           
                              <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="sub_cats[]" id="" value="{{ $cat->id }}" @isset($item) @foreach($item->subCats as $category) {{ $category->id == $cat->id ?'checked':'' }} @endforeach @else {{ $loop->index==0?'checked':'' }}  @endisset>
                                  {{ $cat->name }}
                              </label>
                              <br>
                             @endforeach 
                             </div>
                        </div>

                        
                      <div class="form-group col-md-6 my-3"> 
                       
                             <h5 for="">  <i class="bi bi-arrow-right-short"></i> Country</h5>
                             <div class="form-check"> 

                              @foreach ($countries as $country)  
                               <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="countries[]" id="" value="{{ $country->id }}" @isset($item) @foreach($item->countries as $coun) {{ $country->id == $coun->id ?'checked':'' }} @endforeach @else {{ $loop->index==0?'checked':'' }}  @endisset>
                                  {{ $country->name }}
                               </label>
                               <br>
                               @endforeach
                                
                             </div>
                        </div>

                        <div class="form-group col-md-6 my-3"> 
                          
                          <h5 for="">  <i class="bi bi-arrow-right-short"></i> Brand</h5>
                          
                          


                        @foreach ($brands as $brand) 
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="brand" id="" value="{{ $brand->id }}" @isset($item)  {{ $item->brand->id == $brand->id ?'checked':'' }} @else {{ $loop->index==0?'checked':'' }}  @endisset>
                                {{ $brand->name }}
                              </label>
                            </div>
                        @endforeach
                           
                        </div>

                        <div class="form-group col-md-6 my-3">  
                          <h5 for="">  <i class="bi bi-arrow-right-short"></i> Unit</h5> 
                          @foreach ($units as $unit) 
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="unit" id="" value="{{ $unit->id }}" @isset($item)  {{ $item->unit->id == $unit->id ?'checked':'' }} @else {{ $loop->index==0?'checked':'' }}  @endisset>
                                {{ $unit->name }}
                              </label>
                            </div>
                        @endforeach
                        </div>


                        <div class="form-group col-md-6 my-3"> 
                          
                          <h5 for="">  <i class="bi bi-arrow-right-short"></i>Sub Unit</h5>
                           
                          @foreach ($subUnits as $brand)
                            
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="sub_unit" id="" value="{{ $brand->id }}" @isset($item)  {{ $item->subUnit->id == $brand->id ?'checked':'' }} @else {{ $loop->index==0?'checked':'' }}  @endisset>
                                {{ $brand->name }}
                              </label>
                            </div>
                        @endforeach 
                        </div>

                        

                         <div class="form-group"> 
                           <button class="btn btn-secondary container-fluid mt-3">@isset($item) Update @else Submit  @endisset  </button>
                         </div>

                    </form>
                 

            </div>



          </div>
        </div>
    </div>
@endsection


 