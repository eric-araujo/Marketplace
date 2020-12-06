@extends('layouts.app')

@section('content')
    @if (!$store)
        <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar Loja</a>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>{{$store->id}}</th>
            <th>{{$store->name}}</th>
            <th>
                <div class="btn-group">
                    <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                    <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                    </form>
                </div>
            </th>
        </tr>
        </tbody>
    </table>
@endsection