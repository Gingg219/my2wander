<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CategoryRepository ;
use App\Models\Category;
use App\Repositories\Traits\RepositoryTraits;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
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
        return $model;
    }
}
