@extends('layouts.app')
@section('title')
    Transmissions
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Transmissions</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('types.transmissions.create') }}" class="btn btn-primary form-btn">Transmission <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('types.transmissions.table')
                </div>
            </div>
        </div>

    </section>
@endsection
