<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SkillController extends Controller
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
            'skill' => 'required',
            'level' => 'required',
        ]);

        $profile = Profile::find($id);

        if($profile) {
            $create = $profile->skills()->create([
                'skill' => $request->skill,
                'level' => $request->level,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Tambah skill berhasil',
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
                    "skills" => $profile->skills
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
        $skill = Skill::where([
            ['id', $request->id],
            ['profile_id', $id],
        ])->first();

        if($skill) {
            $skill->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Hapus skill berhasil',
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
