@extends('layouts.app')

@section('template_title')
    Intercambios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Intercambios') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('intercambios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Estado Intercambio</th>
									<th >Fecha Intercambio</th>
									<th >Id Producto Solicitado</th>
									<th >Id Producto Ofrecido</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($intercambios as $intercambio)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $intercambio->estado_intercambio }}</td>
										<td >{{ $intercambio->fecha_intercambio }}</td>
										<td >{{ $intercambio->id_producto_solicitado }}</td>
										<td >{{ $intercambio->id_producto_ofrecido }}</td>

                                            <td>
                                                <form action="{{ route('intercambios.destroy', $intercambio->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('intercambios.show', $intercambio->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('intercambios.edit', $intercambio->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $intercambios->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
