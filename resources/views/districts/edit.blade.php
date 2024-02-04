@extends('layouts.master')
@section('title')
    Edit District    
@endsection

@section('content')
    <div class="container">
        <h1>Edit District</h1>
        
        <form action="{{ route('districts.update',$district->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="district_bn">District Bangla</label>
                    <input value="{{$district->district_bn}}" type="text" name="district_bn" class="form-control" id="district_bn" required>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="district_en">District English</label>
                    <input  value="{{$district->district_en}}" type="text" name="district_en" class="form-control" id="district_en">
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Update District</button>
        </form>
    </div>
@endsection
