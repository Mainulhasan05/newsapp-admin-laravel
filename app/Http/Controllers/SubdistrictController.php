<?php

namespace App\Http\Controllers;

use App\Models\Districts;
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
        $districts=Districts::all();
        return view('subdistricts.create')->with('districts',$districts);
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
        $subdistrict->district_id=$request->district_id;
        $subdistrict->save();
        return redirect()->route('subdistricts.index');
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
        $subdistrict=Subdistricts::with('district')->find($id);
        $districts=Districts::all();
        return view('subdistricts.edit',compact('districts','subdistrict'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'district_id'=>'required'
        ]);
        $subdistrict=Subdistricts::find($id);
        $subdistrict->subdistrict_en=$request->subdistrict_en;
        $subdistrict->subdistrict_bn=$request->subdistrict_bn;
        $subdistrict->district_id=$request->district_id;
        $subdistrict->save();
        return redirect()->route('subdistricts.index');
    }

    public function destroy(string $id)
    {
        $district=Subdistricts::find($id);
        $district->delete();
        return redirect()->route('subdistricts.index');
    }
}
