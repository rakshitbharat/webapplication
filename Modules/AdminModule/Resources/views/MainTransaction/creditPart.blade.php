<div class='form-group'><div class='col-md-4'><textarea class='form-control' id='description' name='"+ uniqueidmaker +"[credit][description]'></textarea><div class='help'>Description</div></div><div class='col-sm-5'><select class='form-control' id='accountId' name='"+ uniqueidmaker +"[credit][accountId]'><option ></option>@foreach($item as $key => $items)<option value='{{ $items['id'] or '' }}'>{{ $items['concatNameCurrentBalance'] or '' }}</option>@endforeach</select>Account</div><div class='col-sm-3'><input type='number' class='form-control' id='amount' min='0' name='"+ uniqueidmaker +"[credit][credit]'><div class='help'>Amount</div><a href='javascript:;' onclick='removeSelf(this)'><i class='fa fa-times-circle-o pull-right' style='color:red;'></i></a></div></div>