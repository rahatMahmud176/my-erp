<tr>
    <td>
        <div class="form-group">
            <select class="form-control my-field item" name="item" required id="item">
                <option value="">--Select--</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </td>

    @if ($setting->color)
        <td>
            <div class="form-group">
                <select class="form-control my-field" name="color_id" id="">
                    @foreach ($colors as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
    @endif

    @if ($setting->size)
        <td>
            <div class="form-group">
                <select class="form-control my-field" name="size_id" id="">
                    @foreach ($sizes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
    @endif
    @if ($setting->country)
        <td>
            <div class="form-group">
                <select class="form-control my-field" name="country_id" id="">
                    @foreach ($countries as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
    @endif

    @if ($setting->qty_manage_by_serial==false )
        <td>
            <input style="width: 100px" name="unit_qty" id="unit_qty" type="text" class="my-field">
        </td>
    @endif  

    @if ($setting->sub_unit)
        <td>
            <input style="width: 100px" name="sub_unit_qty" id="sub_unit_qty" type="number" class="my-field">
            
        </td>
    @endif

    <td>
        <input style="width: 100px" required id="purchase" name="purchase" type="number" class="my-field">
    </td>
    @if ($setting->serial_number)
    <td>
        @if ($setting->qty_manage_by_serial)
            <textarea name="serial" id="" class="form-control my-field"></textarea>
        @else
            <input type="text" name="serial" class="my-field">
        @endif
    </td>
    @endif
    <td>
        <button type="button" class="btn btn-sm btn-danger my-btn"> - </button>
    </td>
</tr>



 
      
<script>  //Todo
        
    $('.item').on('change', function(){
         let id = $(this).val();
          $.ajax({
                type : "GET",
                url : "{{ url('admin/get-item-info') }}",
                data : {id:id},
                success : function(res){
                     console.log(res); 
                     $('#unit_qty').attr('placeholder',res.unit.name);
                     $('#sub_unit_qty').attr('placeholder',res.sub_unit.name);
                }
          })
    })
</script>
 