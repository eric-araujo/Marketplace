@extends('layouts.app')

@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nome do Produto</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group">
            <label>Conteúdo</label>
            <textarea class="form-control" name="body" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label>Preço</label>
            <input type="text" class="form-control" name="price">
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control" name="slug">
        </div>
        <div class="form-group">
            <label>Lojas</label>
            <select class="form-control" name="store">
                @foreach ($stores as $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>    
                @endforeach
            </select>
        </div>
        <div>
            <button class="btn btn-lg btn-success" type="submit">Criar Produto</button>
        </div>
    </form>
@endsection