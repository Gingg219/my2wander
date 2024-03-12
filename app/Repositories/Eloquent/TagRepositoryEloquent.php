<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TagRepository;
use App\Models\Tag as ModelsTag;
use App\Repositories\Traits\RepositoryTraits;
use App\Validators\TagValidator;

/**
 * Class TagRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ModelsTag::class;
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
