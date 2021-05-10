@extends('layouts.app')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                        @if(isset($brand))
                        {{'Edit Brand'}}
                        @else
                        {{'Create Brand'}}
                        @endif
                            <span class="d-block text-muted pt-2 font-size-sm">Cars management made easy</span></h3>
                    </div>
                    <div>
                        <a href="{{route('brands.index')}}" class="btn btn-default float-right">Go Back</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    @if(isset($brand))
                    <form action="{{ route('brands.update',$brand->id) }}" method="POST">
                    @method('PUT')
                    @else
                    <form action="{{route('brands.store')}}" method='post' autocomplete="off">
                    @endif
                    @csrf
                        <!-- Name input -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name"> Brand Name</label>
                                    <input type="text" id="name" class="form-control @error('name') border-danger @enderror" placeholder="Brand Name" name="name" 
                                    value="@isset($brand){{$brand->name}}@endisset"/>                                  
                                </div>
                                @error('name')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary mb-4"> Save Brand </button>
                            </div>
                        </div>
                    </form>    
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection