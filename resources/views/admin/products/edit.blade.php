@extends('layouts.app')

@section('content')
<h1>Criar Produto</h1>
<form action="{{route('admin.products.update', ['product' => $product->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nome do Produto</label>
        <input type="text" class="form-control" name="name" value="{{$product->name}}">
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <input type="text" class="form-control" name="description" value="{{$product->description}}">
    </div>
    <div class="form-group">
        <label>Conteúdo</label>
        <textarea class="form-control" name="body" cols="30" rows="10">{{$product->body}}</textarea>
    </div>
    <div class="form-group">
        <label>Preço</label>
        <input type="text" class="form-control" name="price" value="{{$product->price}}">
    </div>
    <div class="form-group">
        <label>Slug</label>
        <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
    </div>
    <div>
        <button class="btn btn-lg btn-success" type="submit">Editar Produto</button>
    </div>
</form>
@endsection