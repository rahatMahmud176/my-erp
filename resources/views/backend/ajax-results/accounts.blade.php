@foreach ($accounts as $item)
    <option value="{{ $item->id }}">{{ $item->ac_title }}</option>
@endforeach
