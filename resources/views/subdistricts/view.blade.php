@extends('layouts.master')
@section('title')
    Sub Districts    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1>Subdistricts</h1>
                    <button class="btn">
                        <a href="{{ route('subdistricts.create') }}" class="btn btn-primary">Create</a>
                    </button>
                </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SubDistrict Bangla</th>
                        <th>SubDistrict English</th>
                        <th>District Name</th>
                        <th>SubDistrict Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $district)
                    <tr>
                        <td>{{ $district['subdistrict_bn'] }}</td>
                        <td>{{ $district['subdistrict_en'] }}</td>
                        {{-- <td>{{ $district['district_id'] }}</td> --}}
                        <td>{{$district->district?->district_en}}</td>
                        
                        <td>
                            <a href="{{ route('subdistricts.edit', $district['id']) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('subdistricts.destroy', $district['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button> 
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>    
    </div>
@endsection