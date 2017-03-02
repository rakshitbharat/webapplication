@foreach (session()->all() as $key => $value)

@if($key == 'error')
<div class="msgBoxCont">
    <div class="alert alert-danger">
        <span>{{$value}}</span>
        <button class="close" data-close="alert"></button>
    </div>
</div>
@endif

@if($key == 'success')
<div class="msgBoxCont">
    <div class="alert alert-success" style="background-color: #6daf6d; color: #ffffff;">
        <span>{{$value}}</span>
        <button class="close" data-close="alert"></button>
    </div>
</div>
@endif
@endforeach