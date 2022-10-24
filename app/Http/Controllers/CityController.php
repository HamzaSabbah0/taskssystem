<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = City::all();
        return response()->view('cms.cities.index',['cities'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|min:3|max:30'
        ],[
            'name.required'=>'Please , Enter City Name'
        ]);
        $city = new City();
        // $city->name = $request->name;
        $city->name = $request->get('name');
        $isSaved = $city->save();
        if($isSaved){
            session()->flash('message','City Created Successfully');
            return redirect()->back();
            // return redirect()->route('cities.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        return response()->view('cms.cities.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate([
            'name'=>'required|string|min:3|max:30'
        ]);
        $city->name = $request->get('name');
        $isUpdated = $city->save();
        if($isUpdated){
            session()->flash('message','City Updated Successfully');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        // $isDeleted = $city->delete();
        // return redirect()->back();

        $isDeleted = $city->delete();
        if($isDeleted)
        {
            return response()->json([
                'title'=>'Success!','text'=>'City Deleted Successfully','icon'=>'success'
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'title'=>'Faild!','text'=>'City Delete Failed','icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
