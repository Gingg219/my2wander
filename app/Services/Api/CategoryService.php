<?php

namespace App\Services\Api;

use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\CategoryServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class CategoryService implements CategoryServiceInterface
{
    use FileTrait;

    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * ExamplesController constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getAll() {
        return $this->repository->get();
    }
}