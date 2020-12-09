@extends('layouts.front-user')

@section('content')
    <h2 class="alert alert-success">
       Obrigado pela sua compra!
    </h2>
    <h3>
        Seu pedido foi processado, código do pedido: {{request()->get('order')}}
    </h3>
@endsection