@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Categoria
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Categoria</span>
                </div>
                <div class="card-body bg-white">
                    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nombre_categoria">Nombre Categoria</label>
                            <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" value="{{ $categoria->nombre_categoria }}">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection