@extends('layouts.app')
@section('content')

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                        <h3 class="card-label">Update Car
                            <span class="d-block text-muted pt-2 font-size-sm">Cars management made easy</span></h3>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <form action="{{route('cars.update', $car->id)}}" method='post' autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$car->id}}">
                       
                        @csrf
                        @method('PUT')
                        <!-- Name input -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label for=""> Name </label>
                                    <input type="text" name="name" class="form-control" placeholder="Car Name" value="{{$car->name}}"/>
                                    @error('name')
                                    <div class="text-danger check-validation">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <label for="">Brand </label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}"
                                            @if ($brand->id==$car->brand_id)
                                                {{'selected'}}
                                            @endif
                                            >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <div class="text-danger check-validation">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Car Modal</label>
                                <select name="car_modal_id" id="modal_id" class="form-control">
                                    <option value="">Select Car Modal </option>
                                    @foreach ($modals as $modal)
                                        <option value="{{$modal->id}}"
                                            @if ($modal->id==$car->car_modal_id)
                                                {{'selected'}}
                                                @endif
                                            >{{$modal->name}}</option>
                                    @endforeach
                                </select>
                                @error('car_modal_id')
                                <div class="text-danger check-validation">
                                    {{$message}}
                                </div>
                                @enderror   
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <label for="">Colors</label>
                                <select name="color" id="color_id" class="form-control">
                                    <option value="">Select Color</option>
                                    <option value="Red" @if ($car->color=='Red') {{'selected'}} @endif>Red</option>
                                    <option value="white" @if ($car->color=='white') {{'selected'}} @endif>White</option>
                                    <option value="Black" @if ($car->color=='Black') {{'selected'}} @endif>Black</option>
                                </select>
                                @error('color')
                                    <div class="text-danger check-validation">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Years</label>
                                <input type="text" name="year" class="form-control" id="datepicker" value="{{$car->year}}">
                            </div>
                            <div class="col-md-4">
                                @if ($car->images)
                                <img src="/storage/image/{{$car->images}}" width='100' class="mb-2">    
                                @endif
                                <input type="file" name="images" class="form-control">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <button type="submit" class="btn btn-primary my-4 "> Update Car </button>
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

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
    
    $(document).ready(function(){
    // Department Change
        $('#brand_id').change(function(){
            // Department id
            var id = $(this).val();
            // Empty the dropdown
            $('#modal_id').find('option').not(':first').remove();
            // AJAX request 
                $.ajax({
                    url: '../../carsget/'+id,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                    },
                success: function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                    // Read data and create <option >
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;
                            var option = "<option value='"+id+"'>"+name+"</option>"; 
                            $("#modal_id").append(option); 
                        }
                    }
                }
            });
        });
    });

    $('form input[type=text]').focus(function(){
    // get selected input error container
    $(this).next("div").hide();
    // $(this).css('border','1px solid #464E5F');
    });

    $('form select').focus(function(){
    // get selected input error container
    $(this).next("div").hide();
    // $(this).css('border','1px solid #464E5F');
    });

</script>
@endsection