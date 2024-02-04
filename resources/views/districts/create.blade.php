@extends('layouts.master')
@section('title')
    Add District
@endsection

@section('content')
    <div class="container">
        <h1>Add District</h1>
        <form action="{{ route('districts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="district_bn">District Bangla</label>
                    <input type="text" name="district_bn" class="form-control" id="district_bn" required>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="district_en">District English</label>
                    <input type="text" name="district_en" class="form-control" id="district_en">
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Add District</button>
        </form>
    </div>
@endsection
