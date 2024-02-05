@extends('layouts.master')
@section('title')
    Edit Sub District
@endsection

@section('content')
    <div class="container">
        <h1>Edit Sub District</h1>
        <form action="{{ route('subdistricts.update',$subdistrict->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="subdistrict_bn">Subdistrict Bangla</label>
                    <input value="{{$subdistrict->subdistrict_bn}}" type="text" name="subdistrict_bn" class="form-control" id="subdistrict_bn" required>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="subdistrict_en">Subdistrict English</label>
                    <input value="{{$subdistrict->subdistrict_en}}" type="text" name="subdistrict_en" class="form-control" id="subdistrict_en">
                </div>
                
                <div class="form-group mx-2 w-100">
                    <label for="district_id">District</label>
                    <select  name="district_id" class="form-control" id="district_id">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                        <option value="{{ $district->id }}" {{ $subdistrict->district->id == $district->id ? 'selected' : '' }}>
                            {{ $district->district_en }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Update Subdistrict</button>
        </form>
    </div>
@endsection
