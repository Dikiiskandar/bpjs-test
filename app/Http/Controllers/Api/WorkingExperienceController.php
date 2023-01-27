<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class WorkingExperienceController extends Controller
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
    public function store(Request $request)
    {
        //
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
                    "workingExperience" => $profile->workingExperience ?? ''
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
        $profile = Profile::find($id);

        if($profile) {
            $profile->update([
                'workingExperience' => $request->workingExperience
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Update working experience berhasil',
                'data' => [
                    "workingExperience" => $profile->workingExperience ?? ''
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
