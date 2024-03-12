<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Traits\RepositoryTraits;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function buildQuery($model, $filters)
    {

        if($this->isValidKey($filters, 'search')) {
            $model = $model->where(function ($query) use ($filters) {
                $query->orWhere('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('content', 'like', '%' . $filters['search'] . '%');
            });
        }

        if ($this->isValidKey($filters, 'id')) {
            $model = $model->where('id',$filters['id']);
        }

        if($this->isValidKey($filters, 'author')) {
            $author = $filters['search'];
            $model = $model->where('users', function ($query) use ($author) {
                $query->where('users.name', $author);
            });
        }

        if($this->isValidKey($filters, 'category')) {
            $categoryTitle = $filters['search'];
            $model = $model->whereHas('categories', function ($query) use ($categoryTitle) {
                $query->where('categories.title', $categoryTitle);
            });
        }

        if ($this->isValidKey($filters, 'status')) {
            $model = $model->where('status',$filters['status']);
        }

        return $model;
    }
    
}
