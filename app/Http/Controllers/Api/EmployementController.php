<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employement;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'jobTitle' => 'required',
            'employer' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'city' => 'required',
            'description' => 'required',
        ]);

        $profile = Profile::find($id);

        if($profile) {
            $create = $profile->employements()->create([
                'jobTitle' => $request->jobTitle,
                'employer' => $request->employer,
                'startDate' => Carbon::parse($request->endDate),
                'endDate' => Carbon::parse($request->endDate),
                'city' => $request->city,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Tambah employement berhasil',
                'data' => [
                    'profileCode' => $profile->id,
                    'id' => $create->id,
                ]
            ], 201);
        }else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak tidemukan',
                'data' => []
            ], 403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);

        if($profile) {
            return response()->json([
                'status' => 'success',
                'message' => '',
                'data' => [
                    "employements" => $profile->employements
                ]
            ]);
        }else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak tidemukan',
                'data' => []
            ], 403);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $employement = Employement::where([
            ['id', $request->id],
            ['profile_id', $id],
        ])->first();

        if($employement) {
            $employement->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Hapus employement berhasil',
                'data' => [
                    "profileCode" => $id,
                ]
            ], 201);
        }else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan',
                'data' => [
                    "profileCode" => $id
                ]
            ], 403);
        }

    }
}
