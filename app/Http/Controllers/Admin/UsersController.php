<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Council;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $array = [];
        $userTypes = Council::whereNotNull('parent_id')->get();
        foreach ($userTypes as $user) {
            if ($user->children->count() == 0) {
                array_push($array, $user);
            }
        }
        return $userTypes;
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:8',
            'phone_number' => 'required',
            'about' => 'nullable|min:8',
            'image' => 'nullable|image',
            'full_name' => 'nullable|min:10',
            'birthday' => 'nullable|date',
            'type' => 'required',
            'marital_status' => 'required',
            'email' => 'nullable|email',
            'password' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_url = $image->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $user = User::create(
            $request->all()
        );
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|min:8',
            'phone_number' => 'required',
            'about' => 'nullable|min:8',
            'image' => 'nullable|image',
            'full_name' => 'nullable|min:10',
            'birthday' => 'nullable|date',
            'type' => 'required',
            'marital_status' => 'required',
            'email' => 'nullable|email',
            'password' => 'required'
        ]);
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $user->update($request->all());
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('users.index'))->with('success', 'تم حذف العضو');
    }
}
