@extends('layouts.front-user')

@section('content')
    <div class="row">
        <div class="col-md-4">
            @if ($product->photos->count())
                <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="" class="card-img-top mb-4">
                <div class="row">
                    @foreach ($product->photos as $photo)
                        <div class="col-md-5">
                            <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{$product->name}}</h2>
            <p>
                {{$product->description}}
            </p>
            <h3>
                R$ {{number_format($product->price, '2', ',', '.')}}
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