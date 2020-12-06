@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nome da Loja</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="text" class="form-control" name="phone">
        </div>
        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" class="form-control" name="mobile_phone">
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control" name="slug">
        </div>
        <div>
            <button class="btn btn-lg btn-success" type="submit">Criar Loja</button>
        </div>
    </form>
@endsection