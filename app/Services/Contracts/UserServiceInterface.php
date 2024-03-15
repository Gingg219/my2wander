<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function getUser($id);
    public function store($request);
    public function changePassword($request);
}
