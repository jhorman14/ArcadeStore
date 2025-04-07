@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Ver') . ' ' . __('Perfil') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title" style="font-size: 33px">
                        {{ __('Perfil') }}
                            </span>
                        <a class="btn btn-primary btn-sm" href="{{ route('inicio') }}"> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body bg-white py-4">

                        <div class="mb-3">
                            <label for="nick" class="form-label fw-bold" style="font-size: 22px">{{ __('Nick') }}:</label>
                            <p>{{ $user->nick }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold" style="font-size: 22px">{{ __('Correo Electrónico') }}:</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold" style="font-size: 22px">{{ __('Nombre') }}:</label>
                            <p>{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-bold" style="font-size: 22px">{{ __('Teléfono') }}:</label>
                            <p>+57 {{ $user->telefono }}</p>
                        </div>

                        <div class="mt-4 d-grid gap-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('pedidos.index') }}" class="btn btn-info">{{ __('Ver Historial de Pedidos') }}</a>
                                <a href="{{ route('usuario.intercambios') }}" class="btn btn-info">{{ __('Ver Historial de intercambios') }}</a>        
                                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-secondary">{{ __('Editar Perfil') }}</a>
                                <a class="btn btn-info" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesion') }}
                                 </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeactivate">
                                    {{ __('Eliminar Cuenta') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeactivate" tabindex="-1" aria-labelledby="confirmDeactivateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeactivateLabel">{{ __('Confirmar Eliminación de Cuenta') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    <form action="{{ route('profile.deactivate') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ __('Eliminar Cuenta') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
