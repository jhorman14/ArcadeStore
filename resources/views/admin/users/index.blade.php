@extends('layouts.app')

@section('template_title')
    Usuarios
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Juegos') }}
                        </span>
                    </div>
                </div>
                
                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Cambiar rol</th>
                                    <th>Activar usuario</th>
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
                                            <td>

                                            @if(!$user->is_active)
                                                <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary w-100">Activar</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Pagination Section --}}
            <div class="d-flex justify-content-between align-items-center">
                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                    Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} registros
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Botón de Anterior --}}
                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Números de Página --}}
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Botón de Siguiente --}}
                        <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        {{-- End Pagination Section --}}
        </div>
    </div>
</div>
@endsection