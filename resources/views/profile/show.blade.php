@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Ver') . ' ' . __('Perfil') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white" style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="mb-0">{{ __('Mi Perfil') }}</h3>
                        <a class="btn btn-light btn-sm" href="{{ route('inicio') }}"> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body bg-white py-4">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">{{ __('Nombre') }}:</label>
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">{{ __('Correo Electrónico') }}:</label>
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="nick" class="form-label fw-bold">{{ __('Nick') }}:</label>
                            <p class="form-control-plaintext">{{ $user->nick }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-bold">{{ __('Teléfono') }}:</label>
                            <p class="form-control-plaintext">{{ $user->telefono }}</p>
                        </div>

                        <div class="mt-4 d-grid gap-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('pedidos.index') }}" class="btn btn-info">{{ __('Ver Historial de Pedidos') }}</a>    
                                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-secondary">{{ __('Editar Perfil') }}</a>
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
