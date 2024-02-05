@extends('layouts.master')
@section('title')
    Add Sub District
@endsection

@section('content')
    <div class="container">
        <h1>Add Sub District</h1>
        <form action="{{ route('subdistricts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="subdistrict_bn">Subdistrict Bangla</label>
                    <input type="text" name="subdistrict_bn" class="form-control" id="subdistrict_bn" required>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="subdistrict_en">Subdistrict English</label>
                    <input type="text" name="subdistrict_en" class="form-control" id="subdistrict_en">
                </div>

                <div class="form-group mx-2 w-100">
                    <label for="district_id">District</label>
                    <select name="district_id" class="form-control" id="district_id">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->district_en }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <button type="submit" class="btn btn-primary">Add Subdistrict</button>
        </form>
    </div>
@endsection
