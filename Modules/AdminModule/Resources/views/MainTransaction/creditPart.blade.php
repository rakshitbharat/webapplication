<div class='form-group'>
    <div class='col-md-4'>
        <textarea class='form-control' id='description' name='description[debit]'></textarea><div class='help'>Description</div>

    </div>
    <div class='col-sm-5'>
        <select class='form-control' id='accountId' name='accountId[debit]'>
            <option >Select account</option>
            {{ $item = App\Models\Account::pluck('name', 'id') }}
            @foreach($item as $key => $items)
            <option value='{{ $key }}'>{{ $items }}</option>
            @endforeach
        </select>
        Account
    </div>
    <div class='col-sm-3'><input type='number' class='form-control' id='accountId' min='0' name='accountId[debit]'><div class='help'>Amount</div>
    </div>
</div>