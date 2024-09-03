@php
    $totalSale = 0;
    $totalProfit = 0;
@endphp

@foreach ($invoices as $key => $invoice)
    <tr>
        <td>{{ date('d-M-y', strtotime($invoice->created_at)) }}</td>
        <td scope="row">Invoice#{{ $invoice->id }}</td>
        <td scope="row">
            {{ $invoice->customer->name }} <br>
            <small>{{ $invoice->customer->phone_number }}</small>
        </td>
        <td scope="row">{{ $invoice->branch->name }}</td>
        <td scope="row">{{ number_format($total = $invoice->total, 2) }}</td>
        <td scope="row">{{ number_format($due = $total - $invoice->transitions->sum('deposit'), 2) }}</td>
        <td scope="row">
            @php
                $totalPurchasePrice = 0; 
            @endphp
            @foreach ($invoice->details as $detail)
                <input type="hidden" name="" value="{{ $totalPurchasePrice = $totalPurchasePrice + $detail->stock->purchase_price }}">
            @endforeach
            {{ number_format($invoice->total - $totalPurchasePrice, 2) }} 
            <input type="hidden" name="" value="{{ $totalProfit = $totalProfit+ $invoice->total - $totalPurchasePrice }}">
            <input type="hidden" name="" value="{{ $totalSale = $totalSale+ $total }}">
            
        </td>
        <td scope="row">

            @if ($invoice->deletable == true)
                @if ($due != 0)
                    <a href="#" data-id = "{{ $invoice->id }}" data-due = "{{ $due }}"
                        class="btn btn-sm btn-success pay-invoice" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-coin"></i>
                        Pay</a>
                @endif


                <a href="{{ route('admin.invoice.show', $invoice->id) }}" class="btn btn-sm btn-secondary">View</a>
                <a href="#" onclick="invoiceDelete({{ $invoice->id }})" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash3-fill"></i>
                    Delete</a>

                <form id="deleteInvoiceForm{{ $invoice->id }}"
                    action="{{ route('admin.invoice.destroy', $invoice) }}" method="post">
                    @method('DELETE')
                    @csrf
                </form>
            @endif

        </td>

    </tr>
@endforeach
<tr>
    <td></td>
    <th>Total =</th>
    <td></td>
    <td></td>
    <th>Sale: {{ number_format($totalSale) }}</th>
    <td></td>
    <th> Profit: {{ number_format($totalProfit)  }}</th>
    <td></td>
</tr>




<script>
    $('.pay-invoice').on('click', function() {
        let id = $(this).attr('data-id');
        let deu = $(this).attr('data-due');
        $('#pay-amount').attr('max', deu);
        const nFormat = new Intl.NumberFormat(undefined, {
            minimumFractionDigits: 2
        });
        $('#invoice_id').val(id);
        $('#due').val(nFormat.format(deu));
        $('#exampleModalLabel').empty();
        $('#exampleModalLabel').append('Invoice#' + id);
    })
</script>

<script>
    function invoiceDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonInvoice: "#3085d6",
            cancelButtonInvoice: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteInvoiceForm' + id).submit();
            }
        });
    }
</script>
