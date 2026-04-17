@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('users.create') }}" class="btn btn-primary form-btn">
                        User
                        <i class="fas fa-plus"></i>
                    </a>
                @endif
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('users.table')
                </div>
            </div>
        </div>

    </section>
@endsection
