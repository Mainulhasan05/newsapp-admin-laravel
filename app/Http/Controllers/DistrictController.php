<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public function index()
    {
        $districts=Districts::all();
        return view('districts.view',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('districts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'district_en'=>'required'
        ]);
        $district=new Districts();
        $district->district_en=$request->district_en;
        $district->district_bn=$request->district_bn;
        $district->save();
        return redirect()->route('districts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //  get the district by id
        $district=Districts::find($id);
        return view('districts.edit',compact('district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'district_en'=>'required'
        ]);
        $district=Districts::find($id);
        $district->district_en=$request->district_en;
        $district->district_bn=$request->district_bn;
        $district->save();
        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $district=Districts::find($id);
        $district->delete();
        return redirect()->route('districts.index');
    }
}
