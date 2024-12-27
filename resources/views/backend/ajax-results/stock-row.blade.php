<tr>
    <td>
        <div class="form-group">
            <select class="form-control select2 my-field item" name="stock[{{ $i }}][item]" id="item"
                data-id="{{ $i }}">
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
                <select class="form-control my-field" name="stock[{{ $i }}][color_id]" id="">
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
                <select class="form-control my-field" name="stock[{{ $i }}][size_id]" id="">
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
                <select class="form-control my-field" name="stock[{{ $i }}][country_id]" id="">
                    @foreach ($countries as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
    @endif

    @if ($setting->qty_manage_by_serial == false)
        <td>
            <input style="width: 100px" name="stock[{{ $i }}][unit_qty]" id="unit_qty{{ $i }}"
                value="{{ old("stock.$i.unit_qty") }}" type="number" class="my-field">
        </td>
    @endif

    @if ($setting->sub_unit)
        <td>
            <input style="width: 100px" name="stock[{{ $i }}][sub_unit_qty]"
                id="sub_unit_qty{{ $i }}" type="number" class="my-field">

        </td>
    @endif

    <td>
        <input style="width: 100px" id="purchase" name="stock[{{ $i }}][purchase]" type="number"
            class="my-field">
    </td>
    @if ($setting->serial_number)
        <td>
            @if ($setting->qty_manage_by_serial)
                <textarea name="stock[{{ $i }}][serial]" class="form-control my-field serial"
                    data-id="{{ $i }}"></textarea>
            @else
                <input type="text" name="stock[{{ $i }}][serial]" class="my-field serial"
                    data-id="{{ $i }}">
            @endif
            <small class="text-danger"><span class="exitsSerial{{ $i }}"></span> </small>
        </td>
    @endif
    <td>
        <button type="button" class="btn btn-sm btn-danger my-btn stock-row-remove">-</button>
    </td>
</tr>




 


<script>
    //Todo

    $('.item').on('change', function() {
        let id = $(this).val();
        let rowId = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "{{ url('admin/get-item-info') }}",
            data: {
                id: id
            },
            success: function(res) {
                $('#unit_qty' + rowId).attr('placeholder', res.unit.name);
                $('#sub_unit_qty' + rowId).attr('placeholder', res.sub_unit.name);
            }
        })
    })
</script>

<script>
    $('.stock-row-remove').on('click', function() {

        $(this).parent().parent().remove();
    })
</script>


 
 

<script>
    // let debounceTimer;
    $('.serial').on('keyup', function () {
        let serial = $(this).val();
        let dataId = $(this).attr('data-id'); 

        clearTimeout(debounceTimer); // Clear the previous timer
        debounceTimer = setTimeout(() => {
            $.ajax({
                type: "GET",
                url: "{{ url('admin/serial-match') }}",
                data: { serial: serial },
                success: function (res) {
                    // Clear previous results
                    $('.exitsSerial'+dataId).html('');
                    
                    // Ensure `res` is iterable if it's an array of results
                    if (res.length) {
                        res.forEach(item => {
                            $('.exitsSerial'+dataId).append(`<div class="text-danger">already exist: ${item.serial}</div>`);
                        });
                    } else {
                        // $('.exitsSerial'+dataId).html('<div class="text-success">No matching serials found.</div>');
                    }
                },
                error: function (err) {
                    console.error('Error:', err);
                    $('.exitsSerial'+dataId).html('<div>Something went wrong. Please try again.</div>');
                }
            });
        }, 300); // Wait for 300ms after typing stops
    });
</script>