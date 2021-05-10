@extends('layouts.app')
@section('content')

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style>

    .image_area {
      position: relative;
    }

    img {
          display: block;
          max-width: 100%;
    }

    .preview {
          overflow: hidden;
          width: 160px; 
          height: 160px;
          margin: 10px;
          border: 1px solid red;
    }

    .modal-lg{
          max-width: 1000px !important;
    }

    .overlay {
      position: absolute;
      bottom: 10px;
      left: 0;
      right: 0;
      background-color: rgba(255, 255, 255, 0.5);
      overflow: hidden;
      height: 0;
      transition: .5s ease;
      width: 100%;
    }

    .image_area:hover .overlay {
      height: 50%;
      cursor: pointer;
    }

    .text {
      color: #333;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
    }
    
    </style>
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
                            @if(isset($car))
                            {{'Edit Car'}}
                            @else
                            {{'Create Car'}}
                            @endif
                            <span class="d-block text-muted pt-2 font-size-sm">Cars management made easy</span></h3>
                    </div>
                    <div>
                        <a href="{{route('cars.index')}}" class="btn btn-default float-right">Go Back</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    @if(isset($car))
                    <form action="{{route('cars.update', $car->id)}}" method='post' autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$car->id}}">
                    @method('PUT')
                    @else
                    <form action="{{route('cars.store')}}" method='post' autocomplete="off" enctype="multipart/form-data">
                    @endif
                    @csrf
                        <!-- Name input -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label for=""> Name </label>
                                    <input type="text" name="name" class="form-control @error('name') border-danger @enderror " placeholder="Car Name" value="@isset($car){{$car->name}}@endisset"/>
                                    @error('name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <label for="">Brand </label>
                                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') border-danger @enderror">
                                    <option value=""> Select Brand </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}"
                                        @isset($car)
                                        @if($brand->id==$car->brand_id)
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
                            <div class="col-md-4">
                                <label for="">Car Modal</label>
                                <select name="car_modal_id" id="modal_id" class="form-control @error('car_modal_id') border-danger @enderror">
                                    <option value="">Select Car Modal </option>
                                    @foreach ($modals as $modal)
                                        <option value="{{$modal->id}}"
                                        @isset($car)
                                        @if($modal->id==$car->car_modal_id)
                                        {{'selected'}}
                                        @endif
                                        @endisset >{{$modal->name}}</option>
                                    @endforeach
                                </select>
                                @error('car_modal_id')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <label for="">Colors</label>
                                <select name="color" id="color_id" class="form-control @error('color') border-danger @enderror">
                                    <option value=""> Select Color </option>
                                    <option value="Red"
                                    @isset($car)
                                    @if ($car->color=='Red')
                                    {{'selected'}}
                                    @endif
                                    @endisset 
                                    >Red</option>
                                    <option value="white"
                                    @isset($car)
                                    @if ($car->color=='white')
                                    {{'selected'}}
                                    @endif
                                    @endisset
                                    >White</option>
                                    <option value="Black"
                                    @isset($car)
                                    @if ($car->color=='Black')
                                    {{'selected'}}
                                    @endif
                                    @endisset
                                    >Black</option>
                                </select>
                                @error('color')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Years</label>
                                <input type="text" name="year" class="form-control" id="datepicker" @error('year') border-danger @enderror value="@isset($car){{$car->year}}@endisset"  >
                                @error('year')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Image</label>
                                @isset($car)
                                @if ($car->images)
                                <img src="/storage/image/{{$car->images}}" width='100' class="mb-2">    
                                @endif
                                @endisset
                                <div class="image_area">
                                    <label for="upload_image">
                                        <img src="" id="uploaded_image" class="img-responsive img-circle" />
                                        <div></div>
                                        <input type="file" name="images" class="image crop_data @error('images') border-danger @enderror" id="upload_image" value="">
                                    </label>
                                </div>
                                @error('images')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="clearfix"></div>
                            <input type="hidden" name="image_decode" id="tester" />
                            <div class="col">
                                <label for=""> Multiple Images</label>
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                            </div>
                            <div class="clearfix"></div>
                            @isset($car)
                                <div class="col">
                                    <h1>Multiple Images</h1>
                                    @foreach ($images_row as $image)
                                        <img src="/storage/image/uploader_images/{{$image}}" width='100' class="mb-2">
                                    @endforeach
                                </div>    
                            @endisset
                        </div>
                        <div class="clearfix"></div>

                        <div>
                            <button type="submit" class="btn btn-primary my-4 "> Save Car </button>
                        </div>

                        {{-- Modal Image Croppoer --}}

                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Crop Image Before Upload</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="img-container">
                                          <div class="row">
                                              <div class="col-md-8">
                                                  <img src="" id="sample_image" />
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="preview"></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                              </div>
                            </div>
                            {{-- End of Cropper Modal --}}
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

<script type="text/javascript" src="{{asset('js/image_uploader.js')}}"></script>
<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });

    // Images uploader
    $('.input-images-1').imageUploader();

    $('form input[type=text]').focus(function(){
    // get selected input error container
    $(this).next("div").hide();

    });

    $('form select').focus(function(){
    // get selected input error container
    $(this).next("div").hide();
    // $(this).css('border','1px solid #464E5F');
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

// cropper Image

$(document).ready(function(){
    var $modal = $('#modal');
    var image = document.getElementById('sample_image');
    var cropper;

    $('#upload_image').change(function(event){
        $('#uploaded_image').attr('src', "");
        var files = event.target.files;

        var done = function(url){
            image.src = url;
            $modal.modal('show');
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(event)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview:'.preview'
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    $('#crop').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:400
        });

        canvas.toBlob(function(blob){
            
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result; 
                var test=$('#tester').val(base64data);
                $modal.modal('hide');
				$('#uploaded_image').attr('src', base64data);

                // dataNew = new FormData();
                // dataNew.append('image',base64data);           
				// $.ajax({
				// 	url:'../getImage/',
				// 	method:'GET',
                //     dataType: 'json',
                //     data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
				// 	// data:{image:base64data},
				// 	success:function(data)
				// 	{
				// 		$modal.modal('hide');
				// 		$('#uploaded_image').attr('src', data);
				// 	}
				// });
                
            };
        });
    });
});

// Enf of Cropper Image
</script>
@endsection