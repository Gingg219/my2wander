<?php

namespace App\Services\Contracts;

interface PostServiceInterface
{
   public function index($filter);
   public function store($request);
   public function uploadImage($request);
   public function show($id);
   public function edit($id);
   public function getCategoriesByPost($id);
   public function getTagsByPost($id);
   public function getAll();
   public function updateStatus($id);
}
