@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Negocios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('negocios.create') }}" class="btn btn-warning">Nuevo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

