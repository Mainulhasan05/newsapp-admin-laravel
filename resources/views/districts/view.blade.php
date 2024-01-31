@extends('layouts.master')
@section('title')
    Categories    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h1>Categories</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>District Bangla</th>
                        <th>District English</th>
                        <th>District Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $district)
                    <tr>
                        <td>{{ $district['district_bn'] }}</td>
                        <td>{{ $district['district_en'] }}</td>
                        
                        {{-- <td>
                            <a href="{{ route('district.edit', $district['id']) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('district.destroy', $district['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button> 
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>    
    </div>
@endsection