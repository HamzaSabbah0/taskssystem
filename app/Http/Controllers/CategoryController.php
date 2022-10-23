<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::all();
        return response()->view('cms.categories.index',['categories'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.categories.create');
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
        dd($request->all());
        // $validator = Validator($request->all(),
        // [ 'name'=>'required|string|min:3|max:40',
        //   'active'=>'required|boolean' ],
        // );
        // if(!$validator->fails()){
        //     $category = new Category();
        //     $category->name = $request->get('name');
        //     $category->active = $request->get('active');
        //     $isSaved = $category->save();
        //     return response()->json([
        //         'message'=> $isSaved ? "Created Successfully" : "Faild!"],
        //         $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        // }else{
        //     return response()->json([
        //      'message' => $validator->getMessageBag()->first()
        //     ],Response::HTTP_BAD_REQUEST);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return response()->view('cms.categories.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = Validator($request->all(),
    [   'name'=>'required|string|min:3|max|40',
        'active'=>'required|boolean'],
    );
    if(!$validator->fails()){
        $category->name = $request->get('name');
        $category->active = $request->get('active');
        $isUpdated = $category->save();
        return response()->json([
            'message'=> $isUpdated ? "Category Updated Successfully"
        : "Faild to Update Category"],$isUpdated ? Response::HTTP_CREATED :
          Response::HTTP_BAD_REQUEST );
    }else{
        return response()->json([
            'message'=> $validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $isDeleted = $category->delete();
        if($isDeleted){
            return response()->json(['title'=>'Success!','text'=>'Category Deleted Successfully','icon'=>'success'
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>'Faild!','text'=>'Category Delete Faild','icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
