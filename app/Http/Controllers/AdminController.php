<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Admin::where('id','!=',auth('admin')->id())->get();
        return response()->view('panel.pages.admins.index',['admins'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('panel.pages.admins.create', ['roles' => $roles]);
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
        $validator = Validator($request->all(),
        [
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email',
            'active'=>'required|boolean'],
        );
        if(!$validator->fails()){
            $admin = new Admin();
            $role = Role::findById($request->get('role_id'), 'admin');
            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            $admin->active = $request->get('active');
            $isSaved = $admin->save();
            // Mail::to($admin->email)->send(new WelcomeEmail($admin));
            if ($isSaved) {
                event(new Registered($admin));
                $admin->assignRole($role);
            }
            return response()->json([
                'message'=> $isSaved ? "Created Successfully" : "Faild!"],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
             'message' => $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
        $assignedRole = $admin->getRoleNames()[0];
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('panel.pages.admins.edit', [
            'admin' => $admin,
             'roles' => $roles,
             'assignedRole' => $assignedRole
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $validator = Validator($request->all(),[
            'role_id' => 'required|integer|exists:roles,id',
            'name'=>'required|string|min:3|max:30',
            'email'=>'required|email',
            'active'=>'required|boolean'],
         );
    if(!$validator->fails()){
        $role = Role::findById($request->get('role_id'), 'admin');
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->active = $request->get('active');
        $isUpdated = $admin->save();
        if ($isUpdated) {
            // if (!$admin->hasRole($role)) {
            //     $admin->assignRole($role);
            // }
            $admin->syncRoles($role);
        }
        return response()->json([
            'message'=> $isUpdated ? "Admin Updated Successfully"
        : "Faild to Update Admin"],$isUpdated ? Response::HTTP_CREATED :
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
        $isDeleted = $admin->delete();
        if($isDeleted){
            return response()->json(['title'=>'Success!','text'=>'Admin Deleted Successfully','icon'=>'success'
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>'Faild!','text'=>'Admin Delete Faild','icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
