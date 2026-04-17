@extends('layouts.app')
@section('title')
    Edit Vehicle Brand 
@endsection
@section('content')
    <section class="section">
            <div class="section-header">
                <h3 class="page__heading m-0">Edit Vehicle Brand</h3>
                <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                    <a href="{{ route('types.vehicleBrands.index') }}"  class="btn btn-primary">Back</a>
                </div>
            </div>
  <div class="content">
              @include('stisla-templates::common.errors')
              @include('flash::message')
              <div class="section-body">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-body ">
                                    {!! Form::model($vehicleBrand, ['route' => ['types.vehicleBrands.update', $vehicleBrand->id], 'method' => 'patch']) !!}
                                        <div class="row">
                                            @include('types.vehicle_brands.fields')
                                        </div>

                                    {!! Form::close() !!}
                            </div>
                         </div>
                    </div>
                 </div>
              </div>
   </div>
  </section>
@endsection
