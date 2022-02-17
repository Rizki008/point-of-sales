<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
        $member = Member::orderBy('id_member', 'desc')->get();

        return datatables()
            ->of($member)
            ->addIndexColumn()
            ->addColumn('aksi', function ($member) {
                return '
            <div class="btn-group>
            <button onclick="editForm(`' . route('member.update', $member->id_member) . '`)" class="btn btn-warning btn-sm><i class="fa fa-edit"></i></button>
            <button onclick="deleteData(`' . route('member.destroy', $member->id_member) . '`)" class="btn btn-warning btn-sm><i class="fa fa-edit"></i></button>
            </div>
            ';
            })
            ->rowColumns(['aksi'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Member();
        $member->nama_member = $request->nama_member;
        $member->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $id)
    {
        $member = Member::find($id);

        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $id)
    {
        $member = Member::find($id);
        $member->nama_member = $request->nama_member;
        $member->update();

        return response()->json('Data Berhasil Diupdate', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $id)
    {
        $member = Member::find($id);
        $member->delete();

        return response(null, 204);
    }
}
