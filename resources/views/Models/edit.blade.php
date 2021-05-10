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
                        <h3 class="card-label">Create Modals
                            <span class="d-block text-muted pt-2 font-size-sm">Cars management made easy</span></h3>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <form action="{{route('models.update', $model->id)}}" method='post'>
                        @csrf
                        @method('PUT')
                        <!-- Name input -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name"> Model Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Model Name" name="name" value="{{$model->name}}">
                                </div> 
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="brand"> Select Brand</label>
                                <select name="brand_id" class="form-control" id="brand">
                                    <option value="">Selecy Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}"
                                            @if ($brand->id==$model->brand_id)
                                            {{'selected'}}
                                            @endif 
                                            >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <button type="submit" class="btn btn-primary"> Update Model </button>
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