<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Debit</h3>
            </div>
            <div class="box-body">
                @foreach($mainTransaction as $mainTransactions)
                @if($mainTransactions->debit != '')
                <div class='form-group'>
                    <div class='col-md-4'>
                        <textarea class='form-control' id='description' name='{{ $mainTransactions->id }}[debit][description]'>{{ $mainTransactions->description }}</textarea>
                        <div class='help'>Description</div>
                    </div>
                    <div class='col-sm-5'>
                        <select class='form-control' id='{{ $mainTransactions->id }}debitaccountId' name='{{ $mainTransactions->id }}[debit][accountId]'>
                            <option></option>{{ $item = App\Models\Account::pluck('name', 'id') }}@foreach($item as $key => $items)
                            <option value='{{ $key }}'>{{ $items }}</option>@endforeach</select>Account</div>
                    <div class='col-sm-3'>
                        <input type='number' class='form-control' id='amount' min='0' name='{{ $mainTransactions->id }}[debit][debit]' value='{{ $mainTransactions->debit }}'>
                        <div class='help'>Amount</div>
                    </div>
                </div>
                <script type = "text/javascript">
                    $("select").select2({
                        width: '100%',
                    });
                    $('#{{ $mainTransactions->id }}debitaccountId').val('{{ $mainTransactions->accountId }}').trigger("change");
                </script>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Credit</h3>
            </div>
            <div class="box-body">
                @foreach($mainTransaction as $mainTransactions)
                @if($mainTransactions->credit != '')
                <div class='form-group'>
                    <div class='col-md-4'>
                        <textarea class='form-control' id='description' name='{{ $mainTransactions->id }}[credit][description]'>{{ $mainTransactions->description }}</textarea>
                        <div class='help'>Description</div>
                    </div>
                    <div class='col-sm-5'>
                        <select class='form-control' id='{{ $mainTransactions->id }}creditaccountId' name='{{ $mainTransactions->id }}[credit][accountId]'>
                            <option></option>{{ $item = App\Models\Account::pluck('name', 'id') }}@foreach($item as $key => $items)
                            <option value='{{ $key }}'>{{ $items }}</option>@endforeach</select>Account</div>
                    <div class='col-sm-3'>
                        <input type='number' class='form-control' id='amount' min='0' name='{{ $mainTransactions->id }}[credit][credit]' value='{{ $mainTransactions->credit }}'>
                        <div class='help'>Amount</div>
                    </div>
                </div>
                <script type = "text/javascript">
                    $("select").select2({
                        width: '100%',
                    });
                    $('#{{ $mainTransactions->id }}creditaccountId').val('{{ $mainTransactions->accountId }}').trigger("change");
                </script>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>