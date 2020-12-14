@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como lidas!</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Notificação</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($unreadNotifications as $unread)
            <tr>
                <th>{{$unread->data['message']}}</th>
                <th>{{$unread->created_at->locale('pt')->diffForHumans()}}</th>
                <th>
                    <div class="btn-group">
                        <a href="{{route('admin.notifications.read', ['notification' => $unread->id])}}" class="btn btn-sm btn-primary">Marcar como lida</a>
                    </div>
                </th>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <div class="alert alert-warning">Nenhuma notificação encontrada!</div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection