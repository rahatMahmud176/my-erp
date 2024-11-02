@foreach ($suppliers as $key => $supplier)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $supplier->name }}</td>
        <td>{{ $supplier->phone_number }}</td>

        <td>
            {{ number_format($supplier->transitions->sum('due') - $supplier->transitions->sum('deposit'), 2) }}
            (new)
            <br>
            {{ number_format($supplier->challans->sum('total') - $supplier->challans->sum('pay'), 2) }}
        </td>

        <td>
            <a href="#" class="btn btn-sm btn-success pay-button" data-id="{{ $supplier->id }}" data-bs-toggle="modal"
                data-bs-target="#payModal"> Pay</a>
            <a href="#" class="btn btn-sm btn-success adjust-button" data-id="{{ $supplier->id }}"
                data-bs-toggle="modal" data-bs-target="#adjustModal"> Adjust</a>
            <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-pencil-square"></i>
                Edit
            </a>

            <a href="{{ route('admin.suppliers.show', $supplier) }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-eye"></i>
                View
            </a>

            {{-- <a href="#" onclick="supplierDelete({{ $supplier->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteSupplierForm{{ $supplier->id }}"
                                                    action="{{ route('admin.suppliers.destroy', $supplier) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                </form> --}}


        </td>
    </tr>
@endforeach


<script>
    $('.pay-button').on('click', function() {
        let id = $(this).attr('data-id');
        $('#supplier_id').val(id);
    })
</script>
<script>
    $('.adjust-button').on('click', function() {
        let id = $(this).attr('data-id');
        $('.supplier_id').val(id);
    })
</script>


<script>
    function supplierDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonSupplier: "#3085d6",
            cancelButtonSupplier: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteSupplierForm' + id).submit();
            }
        });
    }
</script>