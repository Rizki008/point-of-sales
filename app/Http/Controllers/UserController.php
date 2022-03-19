<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function data()
    {
        $user = User::isNotAdmin()->orderBy('id', 'desc')->get();

        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                return '
                <div class="btn btn-group">
                <button type="button" onclick="editForm(`' . route('user.update', $user->id) . '`)" class="btn btn-warning btn-sm"><i class="fa fa-pen-fancy"></i></button>
                <button type="button" onclick="deleteData(`' . route('user.destroy', $user->id) . '`)" class="btn btn-denger btn-sm"><i class="fa fa-trash"></i></button>
                </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = 2;
        $user->foto = '/img/avatar5.png';
        $user->save();

        return response()->json('Data Berhasil Ditambahkan', 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "")
            $user->password = $request->password;
        $user->update();

        return response()->json('Data Berhasil Di update', 200);
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return response(null, 204);
    }
}
