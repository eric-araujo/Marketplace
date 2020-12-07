@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nome da Loja</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
            
            @error('name')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description')}}">

            @error('description')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}">

            @error('phone')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" value="{{old('mobile_phone')}}">
            
            @error('mobile_phone')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">

            @error('logo')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control" name="slug" value="{{old('slug')}}">
        </div>
        <div>
            <button class="btn btn-lg btn-success" type="submit">Criar Loja</button>
        </div>
    </form>
@endsection