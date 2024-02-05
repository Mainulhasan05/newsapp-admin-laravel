<?php

namespace App\Http\Controllers;

use App\Models\Subdistricts;
use Illuminate\Http\Request;

class SubdistrictController extends Controller
{

    public function index()
    {
        $districts=Subdistricts::with('district')->get();
        // dd($districts[0]->district->district_en);
        return view('subdistricts.view',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subdistricts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'subdistrict_bn'=>'required'
        ]);
        $subdistrict=new Subdistricts();
        $subdistrict->subdistrict_en=$request->subdistrict_en;
        $subdistrict->subdistrict_bn=$request->subdistrict_bn;
        $subdistrict->save();
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
        $district=Subdistricts::find($id);
        return view('subdistricts.edit',compact('district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'district_en'=>'required'
        ]);
        $district=Subdistricts::find($id);
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
        $district=Subdistricts::find($id);
        $district->delete();
        return redirect()->route('districts.index');
    }
}
