@extends('layouts.front-user')

@section('content')
    <div class="row mb-3">
        @foreach ($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 98%; height:100%;">
                    
                        @if ($product->photos->count())
                            <img src="{{asset('storage/' . $product->thumb)}}" alt="" class="card-img-top">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{$product->name}}</h2>
                            <p class="card-text">{{$product->description}}</p>
                            <h3>
                                R$ {{number_format($product->price, '2', ',', '.')}}
                            </h3>
                            <a href="{{route('product.sigle', ['slug' => $product->slug])}}" class="btn btn-success">
                                Ver Produto
                            </a>
                        </div>
                </div>
            </div>
            @if (($key + 1) % 3 == 0)
                </div>
                <div class="row mb-3">
            @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Lojas em Destaque</h2>
            <hr>
        </div>
        @foreach ($stores as $store)
            <div class="col-md-4">
                @if ($store->logo)
                    <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid">
                @else
                    <img src="https://via.placeholder.com/600X300.png?text=logo" alt="A loja {{$store->name}} não tem logo" class="img-fluid">
                @endif
                <h3>{{$store->name}}</h3>
                <p>{{$store->description}}</p>
                <a href="{{route('store.sigle', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
            </div>
        @endforeach
    </div>
@endsection