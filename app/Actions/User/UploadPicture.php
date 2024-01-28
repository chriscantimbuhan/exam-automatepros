<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadPicture
{
    protected $model;

    protected $picture;

    public function __construct(User $user) {
        $this->model = $user;
    }

    /**
     * Execute action
     */
    public function execute()
    {
        DB::transaction(function () {
            $this->uploadFile();
        });
    }

    /**
     * Set Requests
     */
    public function setRequest(Request $request)
    {
        $this->picture = $request->file('picture');

        return $this;
    }

    /**
     * Upload selected file
     */
    protected function uploadFile()
    {
        $picture = $this->picture;

        $fileName = 'profile.' . $picture->extension();

        if (file_exists(public_path('profile/' . $fileName))) {
            unlink(public_path('profile/' . $fileName));
        }

        $picture->move(public_path('profile'), $fileName);
    }

    protected function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }
}
