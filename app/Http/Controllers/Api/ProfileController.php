<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all();

        return response()->json([
            'status' => 'success',
            'message' => '',
            'data' => $profiles
        ]);
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
            'wantedJobTitle' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:profiles',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postalCode' => 'required|numeric',
            'drivingLicense' => 'required',
            'nationality' => 'required',
            'placeOfBirth' => 'required',
            'dateOfBirth' => 'required|date',
        ]);

        $profile = Profile::create([
            'wantedJobTitle' => $request->wantedJobTitle,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'postalCode' => $request->postalCode,
            'drivingLicense' => $request->drivingLicense,
            'nationality' => $request->nationality,
            'placeOfBirth' => $request->placeOfBirth,
            'dateOfBirth' => Carbon::parse($request->dateOfBirth),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Buat profile berhasil',
            'data' => $profile
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        if($profile) {
            return response()->json([
                'status' => 'success',
                'message' => '',
                'data' => $profile
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
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'wantedJobTitle' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:profiles,email,' . $profile->id ?? '',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postalCode' => 'required|numeric',
            'drivingLicense' => 'required',
            'nationality' => 'required',
            'placeOfBirth' => 'required',
            'dateOfBirth' => 'required|date',
        ]);

        if($profile) {
            $profile->update([
                'wantedJobTitle' => $request->wantedJobTitle,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'postalCode' => $request->postalCode,
                'drivingLicense' => $request->drivingLicense,
                'nationality' => $request->nationality,
                'placeOfBirth' => $request->placeOfBirth,
                'dateOfBirth' => Carbon::parse($request->dateOfBirth),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Update profile berhasil',
                'data' => $profile
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
