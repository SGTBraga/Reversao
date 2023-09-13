@if ($errors->any())
<div class="callout callout-warning">
    <h4>Atenção</h4>
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif

@if(session('success'))
<div class="callout callout-success">
    <h4><i class="fa fa-check"></i> Sucesso</h4>
    <p> {{session('success')}}</p>
</div>
@endif

@if(session('error'))
<div class="callout callout-danger">
    <h4><i class="fa fa-close"></i> Erro</h4>
    <p>{{session('error')}}</p>
</div>
@endif