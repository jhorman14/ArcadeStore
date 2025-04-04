@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Usuarios</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            @if($user->role === 'user')
                                <form action="{{ route('admin.users.change-role', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="admin">
                                    <button type="submit" class="btn btn-sm btn-success">Convertir a Admin</button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.change-role', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="user">
                                    <button type="submit" class="btn btn-sm btn-warning">Convertir a Usuario</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection