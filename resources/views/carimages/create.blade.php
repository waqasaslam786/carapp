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
                        <h3 class="card-label"> Upload Car Images
                            <span class="d-block text-muted pt-2 font-size-sm">Cars management made easy</span></h3>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <form action="{{route('carimages.store')}}" method='post' enctype="multipart/form-data">
                        @csrf
                        <!-- Name input -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name"> Cars </label>
                                    <select name="car_id" id="" class="form-control">
                                        <option value=""> Select Car</option>
                                        @foreach ($cars as $car)
                                            <option value="{{$car->id}}">{{$car->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('car_id')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name"> Car Images </label>
                                    <input type="file" id="name" class="form-control @error('multiple_images') border-danger @enderror" name="multiple_images[]" multiple/>                                  
                                </div>
                                @error('multiple_images')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary mb-4"> Save Multiple Images </button>
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