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
                            @if(isset($model))
                            {{'Edit Modal'}}
                            @else
                            {{'Create Modal'}}
                            @endif
                            <span class="d-block text-muted pt-2 font-size-sm">Cars management made easy</span></h3>
                    </div>
                    <div>
                        <a href="{{route('models.index')}}" class="btn btn-default float-right">Go Back</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    @if(isset($model))
                    <form action="{{route('models.update', $model->id)}}" method='post'>
                    @method('PUT')
                    @else
                    <form action="{{route('models.store')}}" method='post' autocomplete="off">
                    @endif
                    @csrf
                        <!-- Name input -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name"> Model Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Model Name" name="name" value="@isset($model){{$model->name}}@endisset"/>
                                    @error('name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="brand"> Select Brand</label>
                                <select name="brand_id" class="form-control" id="brand">
                                    <option value=""> Select Brand </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}"
                                            @isset($model)
                                            @if ($brand->id==$model->brand_id)
                                            {{'selected'}}
                                            @endif
                                            @endisset >{{$brand->name}}</option>
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
                            <button type="submit" class="btn btn-primary"> Save Modal </button>
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