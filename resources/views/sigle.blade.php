@extends('layouts.front-user')

@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <h2>{{$product->name}}</h2>
            <p>
                {{$product->description}}
            </p>
            <h3>
                {{$product->price}}
            </h3>
            <span>
                Loja: {{$product->store->name}}
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            {{$product->body}}
        </div>
    </div>
@endsection