@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>
    </div>

    <div class="col-md-12">
        <div class="accordion mb-5" id="accordionExample">
            @forelse ($orders as $key => $order)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                Pedido nº: {{$order->reference}}
                            </button>
                        </h2>
                    </div>
                
                    <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">
                   Nenhum pedido recebido; 
                </div>
            @endforelse
        </div>
        {{$orders->links('pagination::bootstrap-4')}}
    </div>
@endsection