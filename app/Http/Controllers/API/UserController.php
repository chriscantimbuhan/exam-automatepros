<?php

namespace App\Http\Controllers\API;

use App\Actions\User\StoreOrUpdateUser;
use App\Actions\User\UploadPicture;
use App\Http\Controllers\Controller;
use App\Http\Requests\PictureUploadRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = (new User)->newQuery();

        $data = $query->paginate($request->input('per_page') ?? 5);

        if ($request->ajax()) {
            return view('layouts.partials.paginated-data', compact('data'));
        }
    
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        (new StoreOrUpdateUser)
            ->setRequest($request)
            ->execute();

        return response([
            'status' => 'success',
            'redirect' => route('dashboard')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PictureUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadPicture(PictureUploadRequest $request, User $user)
    {
        (new UploadPicture($user))
            ->setRequest($request)
            ->execute();

        return response([
            'status' => 'success',
            'redirect' => route('dashboard')
        ]);
    }

    public function getPicture()
    {
        return asset('profile/profile.png');
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
    public function destroy($id)
    {
        //
    }
}
