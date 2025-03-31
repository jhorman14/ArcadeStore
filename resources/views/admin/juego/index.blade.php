@extends('layouts.app')

@section('template_title')
    Juegos
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

                             <div class="float-right">
                                 <a href="{{ route('juegos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                   {{ __('Create New') }}
                                 </a>
                             </div>
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
                                        <th>No</th>

                                        <th >Titulo</th>
                                        <th >Precio</th>
                                        <th >Descripcion</th>
                                        <th >Requisitos Minimos</th>
                                        <th >Requisitos Recomendados</th>
                                        <th >Id Categoria</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($juegos as $juego)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td >{{ $juego->titulo }}</td>
                                            <td >{{ $juego->precio }}</td>
                                            <td >{{ $juego->descripcion }}</td>
                                            <td >{{ $juego->requisitos_minimos }}</td>
                                            <td >{{ $juego->requisitos_recomendados }}</td>
                                            <td >{{ $juego->id_categoria }}</td>

                                            <td>
                                                <form action="{{ route('juegos.destroy', $juego->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('juegos.edit', $juego->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $juegos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection