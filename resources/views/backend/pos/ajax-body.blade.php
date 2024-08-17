@foreach ($stocks as $stock)
<tr>
     <td>{{ $stock->item->name }}</td>
     <td>{{ $stock->color->name.','. $stock->size->name.','. $stock->country->name }}</td>
     <td>{{ $stock->unit_qty.' '.$stock->item->unit->name }} 
        @if ($settings->sub_unit)
        {{ ' / '.$stock->sub_unit_qty.' '.$stock->item->subUnit->name  }} 
        @endif
     </td>
     <td>{{ $stock->serial }}</td>
     <td><a href="#" class="cart-icon" data-id="{{ $stock->id }}">
         <i class="bi bi-cart-plus-fill"></i>
         </a></td>
 </tr>
@endforeach 


<script>
    $('.cart-icon').on('click', function() {
        let id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "{{ url('admin/add-to-cart-ajax') }}",
            data: {
                id: id
            },
            success: function(res) {
                // console.log(res);
                toastr.success(res);
            }
        })
    })
</script>