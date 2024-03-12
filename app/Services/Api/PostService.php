<?php

namespace App\Services\Api;

use App\Enums\PublishedEnum;
use App\Repositories\Contracts\PostRepository;
use App\Services\Contracts\PostServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class PostService implements PostServiceInterface
{
    use FileTrait;

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * ExamplesController constructor.
     *
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index($filter)
    {
        if (@$filter['status'] === "all") {
            @$filter['vote'] = null;
        }
        return $this->repository->paginateByFilters(
            $filter,
            10,
            ['user:id,name','categories'],
            ['created_at' => 'desc']);
     }

    public function store($request)
    {
        $post = $this->repository->create($request->all());
        $post->categories()->sync($request['categories']);
        $post->tags()->sync($request['tags']);
        return $post;
    }
    public function uploadImage($request) {
        $uploadImage = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = 'posts';
                $uploadFile = $this->upload($image, $path);
                
                if (!$uploadFile) return null;
    
                $uploadImage[] = $uploadFile;
            }
        }
        return $uploadImage;
    }
    public function show($id)
    {
        $post = $this->repository->firstByFilters(
            ['id'=>$id],
            ['categories:id,title','tags:id,title'],
        );
        
        if (!$post) {
            abort(404);
        }
        return $post;
    }
    public function edit($id)
    {
        $post = $this->repository->find($id);
        return $post;
    }
    public function getCategoriesByPost($id)
    {
        $categoriesByPost = $this->repository->find($id)->categories()->pluck('id','title')->toArray();
        return $categoriesByPost;
    }
    public function getTagsByPost($id)
    {
        $tagsByPost = $this->repository->find($id)->tags()->pluck('id','title')->toArray();
        return $tagsByPost;
    }
    public function getAll()
    {
        $posts = $this->repository->get();
        return $posts;
    }
    public function updateStatus($id)
    {
        $post = $this->repository->firstById($id);
        if ($post['status'] === PublishedEnum::Published) {
            return $this->repository->update(['status' => PublishedEnum::Pending],$id);
        }
        return $this->repository->update(['status' => PublishedEnum::Published],$id);
    }
}