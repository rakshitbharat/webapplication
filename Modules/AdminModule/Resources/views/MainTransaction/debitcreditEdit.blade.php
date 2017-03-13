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
                        <textarea class='form-control' id='description' name='transactionCode[{{ $mainTransactions->id }}][description]'>{{ $mainTransactions->description }}</textarea>
                        <div class='help'>Description</div>
                    </div>
                    <div class='col-sm-5'>
                        <select class='form-control' id='{{ $mainTransactions->id }}debitaccountId' name='transactionCode[{{ $mainTransactions->id }}][accountId]'>
                            <option></option>
                            @foreach(App\Models\Account::concatNameCurrentBalance() as $key => $items)<option value='{{ $items['id'] or '' }}'>{{ $items['concatNameCurrentBalance'] or '' }}</option>@endforeach
                        </select>Account</div>
                    <div class='col-sm-3'>
                        <input type='number' class='form-control' id='amount' min='0' name='transactionCode[{{ $mainTransactions->id }}][debit]' value='{{ $mainTransactions->debit }}'>
                        <div class='help'>Amount</div>
                    </div>
                </div>
                <input type='hidden' name='transactionCode[{{ $mainTransactions->id }}][id]' value='{{ $mainTransactions->id }}'>
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
                        <textarea class='form-control' id='description' name='transactionCode[{{ $mainTransactions->id }}][description]'>{{ $mainTransactions->description }}</textarea>
                        <div class='help'>Description</div>
                    </div>
                    <div class='col-sm-5'>
                        <select class='form-control' id='{{ $mainTransactions->id }}creditaccountId' name='transactionCode[{{ $mainTransactions->id }}][accountId]'>
                            <option></option>
                            @foreach(App\Models\Account::concatNameCurrentBalance() as $key => $items)<option value='{{ $items['id'] or '' }}'>{{ $items['concatNameCurrentBalance'] or '' }}</option>@endforeach
                        </select>Account</div>
                    <div class='col-sm-3'>
                        <input type='number' class='form-control' id='amount' min='0' name='transactionCode[{{ $mainTransactions->id }}][credit]' value='{{ $mainTransactions->credit }}'>
                        <div class='help'>Amount</div>
                    </div>
                </div>
                <input type='hidden' name='transactionCode[{{ $mainTransactions->id }}][id]' value='{{ $mainTransactions->id }}'>
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