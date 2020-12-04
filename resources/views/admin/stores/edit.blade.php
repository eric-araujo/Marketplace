@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nome da Loja</label>
            <input type="text" class="form-control" name="name" value="{{$store->name}}">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control" name="description" value="{{$store->description}}">
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="text" class="form-control" name="phone" value="{{$store->phone}}">
        </div>
        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" class="form-control" name="mobile_phone" value="{{$store->mobile_phone}}">
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control" name="slug" value="{{$store->slug}}">
        </div>
        <div>
            <button class="btn btn-lg btn-success" type="submit">Editar Loja</button>
        </div>
    </form>
@endsection