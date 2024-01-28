<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StoreOrUpdateUser
{
    protected $model;

    protected $password;

    public function __construct(User $user = null) {
        $this->model = $user ?? new User;
    }

    /**
     * Run the action
     *
     * @return void
     */
    public function execute()
    {
        DB::transaction(function () {
            $this->beforeModelSave();

            $this->model->save();
        });
    }

    /**
     * Set Requests data
     */
    public function setRequest(Request $request)
    {
        $this->prepareRequest($request);

        return $this;
    }

    /**
     * Run before model is saved
     *
     * @return void
     */
    protected function beforeModelSave()
    {
        $this->model->password =  Hash::make($this->password);
    }

    /**
     * Prepare requests
     */
    protected function prepareRequest(Request $request)
    {
        $this->setPassword($request->input('password'));

        collect($this->model->getFillable())->each(function ($field) use ($request) {
            $this->model->$field = $request->input($field);
        });
    }

    /**
     * Set password attribute
     */
    protected function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
