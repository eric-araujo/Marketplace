@extends('layouts.app')

@section('content')
    <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como lidas!</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Notificação</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($unreadNotifications as $unread)
            <tr>
                <th>{{$unread->data['message']}}</th>
                <th>{{$unread->created_at->locale('pt')->diffForHumans()}}</th>
                <th>
                    <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-primary">Marcar como lida</a>
                    </div>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection