@foreach ($challans as $key => $challan)
    <tr>
        <td>{{ date('d-M-y', strtotime($challan->created_at)) }}</td>
        <td scope="row">Challan#{{ $challan->id }}</td>
        <td class="text-center"><a href="#">{{ $challan->supplier->name }}</a></td>
        <td class="text-center">{{ number_format($challan->total, 2) }}</td>
        {{-- <td class="text-success text-center">{{ number_format($challan->pay, 2) }}</td>
        <td class="{{ $challan->due == 0 ? 'text-success' : 'text-danger' }} text-center">
            {{ number_format($challan->due, 2) }}
        </td> --}}

        <td class="text-center">

            {{-- @if ($challan->due != 0)
                <a href="#" data-id = "{{ $challan->id }}" data-due = "{{ $challan->due }}"
                    data-supplier = "{{ $challan->supplier->name }}" data-supplier_id = "{{ $challan->supplier_id }}"
                    class="btn btn-sm btn-success pay-challan" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-coin"></i>
                    Pay</a>
            @endif --}}

            @if ($challan->deletable == true)
                <a href="{{ route('admin.challans.show',$challan) }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-eye"></i>
                    View</a>

                <a href="#" onclick="challanDelete({{ $challan->id }})" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash3-fill"></i>
                    Delete</a>

                <form id="deleteChallanForm{{ $challan->id }}"
                    action="{{ route('admin.challans.destroy', $challan) }}" method="post">
                    @method('DELETE')
                    @csrf
                </form>
            @endif

        </td>
    </tr>
@endforeach

 




<script>
    $('.pay-challan').on('click', function(){
        let id = $(this).attr('data-id');
        let deu = $(this).attr('data-due');
        let supplier = $(this).attr('data-supplier');
        let supplier_id = $(this).attr('data-supplier_id');

        $('#pay-amount').attr('max', deu);
        const nFormat = new Intl.NumberFormat(undefined, {minimumFractionDigits: 2});
        $('#challan_id').val(id);
        $('#supplier_id').val(supplier_id);
        $('#due').val(nFormat.format(deu));
        $('#exampleModalLabel').empty();
        $('#exampleModalLabel').append('Challan#'+id); 
    })
</script> 
 
    <script>
        function challanDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonChallan: "#3085d6",
                cancelButtonChallan: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteChallanForm' + id).submit();
                }
            });
        }
    </script>