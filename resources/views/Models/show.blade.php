@extends('layouts.app')
@section('content')
<div class="flex justify-center">
    <div class="p-6 bg-white rounded-lg container">
        <div class="jumbotron">
            <h1> Car Brands </h1>      
            <p> Create New Brand.</p>
        </div>
        <div class="form-section">
            <form action="{{route('models.update', $model->id)}}" method='post'>
                @csrf
                @method('PUT')
                <!-- Name input -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline col-sm-6 mb-4">
                            <label class="form-label" for="name"> Model Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Model Name" name="name" value="{{$model->name}}">
                        </div>
                        <div class="form-outline col-sm-6 mb-4">
                            <label class="form-label" for="brand"> Select Brand</label>
                            <select name="brand_id" class="form-control" id="brand">
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}"
                                        @if ($brand->id==$model->brand_id)
                                        {{'selected'}}
                                        @endif 
                                        >{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary mb-4"> Update Model </button>
                    </div>
                </div>
           
        </div>        
    </div>
</div>
@endsection