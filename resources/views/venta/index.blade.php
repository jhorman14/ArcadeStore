@extends('layouts.app')

@section('template_title')
    Ventas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Ventas') }}
                            </span>
                            <div class="float-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}"> {{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        {{-- Search and Filter Bar --}}
                        <div class="mb-3">
                        <form action="{{ route('ventas.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" placeholder="Buscar por usuario o juego..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Fecha Venta</th>
                                        <th>Usuario</th>
                                        <th>Juego</th>
                                        <th>Pedido</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ventas as $venta)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $venta->fecha_venta }}</td>
                                            <td>{{ $venta->user->name }}</td>
                                            <td>{{ $venta->juego->titulo }}</td>
                                            <td>{{ $venta->juego->precio }}</td> //
                                            <td>{{ $venta->pedido ? $venta->pedido->id : 'N/A' }}</td>
                                            <td>
                                                <form action="{{ route('ventas.destroy',$venta->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ventas.show',$venta->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No hay ventas registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pagination Section --}}
        <div class="d-flex justify-content-between align-items-center">
            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                Mostrando {{ $ventas->firstItem() }} a {{ $ventas->lastItem() }} de {{ $ventas->total() }} registros
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Botón de Anterior --}}
                    <li class="page-item {{ $ventas->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $ventas->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    {{-- Números de Página --}}
                    @for ($i = 1; $i <= $ventas->lastPage(); $i++)
                        <li class="page-item {{ $ventas->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $ventas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Botón de Siguiente --}}
                    <li class="page-item {{ $ventas->currentPage() == $ventas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $ventas->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        {{-- End Pagination Section --}}
    </div>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../js/datatables.min.js"></script>    

    <!-- para usar botones en datatables JS -->  
    <script src="../js/dataTables.buttons.min.js"></script>  
    <script src="../js/jszip.min.js"></script>    
    <script src="../js/pdfmake.min.js"></script>    
    <script src="../js/vfs_fonts.js"></script>
    <script src="../js/buttons.html5.min.js"></script>

    <!-- código JS propìo-->    
    <script type="text/javascript" src="../js/main.js"></script>

@endsection