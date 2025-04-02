@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Intercambio
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Intercambio</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('intercambios.update', $intercambio->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('intercambio.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
