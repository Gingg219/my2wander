<?php

namespace App\Services\Api;

use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    use FileTrait;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * ExamplesController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this -> repository = $repository;
    }
    public function getUser($id) {
        return $this -> repository->firstByFilters(['id' => $id]);
    }

    public function store($request)
    {
        $request = $request -> only([
            'name',
            'mobile',
            'email',
        ]);
        $user = $this -> repository -> updateByFilters(
            ['id' => auth()->user()->id],
            [
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'email' => $request['email'],
            ]
        );
        return $user;
    }

    public function changePassword($request) {
        $password = Hash::make($request['new_password']);
        $user = $this -> repository -> updateByFilters(
            ['id' => auth()->user()->id],
            [
                'password' => $password,
            ]
        );
        return $user;
    }
        
}