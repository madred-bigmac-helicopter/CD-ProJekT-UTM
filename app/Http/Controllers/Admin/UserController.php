<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $rolesColection = Role::all();

        $roles = array('' => 'all');
        foreach ($rolesColection as $role)
            $roles[$role->name] = $role->name;

        $userRole = $user->getRoleNames()->toArray();
        if (count($userRole) > 0)
            $userRole = $userRole[0];

        return view('admin.users.edit')->with(compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];

        // User can have only one role
        $user->syncRoles([$request['role']]);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User data successfully updated!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::where('id', $id)
            ->delete();
        return redirect('/admin/users');
    }
}
