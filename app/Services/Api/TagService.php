<?php

namespace App\Services\Api;

use App\Repositories\Contracts\TagRepository;
use App\Services\Contracts\TagServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class TagService implements TagServiceInterface
{
    use FileTrait;

    /**
     * @var TagRepository
     */
    protected $repository;

    /**
     * ExamplesController constructor.
     *
     * @param TagRepository $repository
     */
    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getAll() {
        return $this->repository->get();
    }
}