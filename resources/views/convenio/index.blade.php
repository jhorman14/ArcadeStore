@extends('layouts.app')

@section('template_title')
    Convenios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Convenios') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('convenios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Descripcion</th>
									<th >Fecha Inicio</th>
									<th >Fecha Fin</th>
									<th >Id Usuario</th>
									<th >Id Juego</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($convenios as $convenio)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $convenio->descripcion }}</td>
										<td >{{ $convenio->fecha_inicio }}</td>
										<td >{{ $convenio->fecha_fin }}</td>
										<td >{{ $convenio->id_usuario }}</td>
										<td >{{ $convenio->id_juego }}</td>

                                            <td>
                                                <form action="{{ route('convenios.destroy', $convenio->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('convenios.show', $convenio->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('convenios.edit', $convenio->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $convenios->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
