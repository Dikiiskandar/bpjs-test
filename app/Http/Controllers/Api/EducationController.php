<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EducationController extends Controller
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
            'school' => 'required',
            'degree' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'city' => 'required',
            'description' => 'required',
        ]);

        $profile = Profile::find($id);

        if($profile) {
            $create = $profile->educations()->create([
                'school' => $request->school,
                'degree' => $request->degree,
                'startDate' => Carbon::parse($request->endDate),
                'endDate' => Carbon::parse($request->endDate),
                'city' => $request->city,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Tambah education berhasil',
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
                    "educations" => $profile->educations
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
        $education = Education::where([
            ['id', $request->id],
            ['profile_id', $id],
        ])->first();

        if($education) {
            $education->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Hapus education berhasil',
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
