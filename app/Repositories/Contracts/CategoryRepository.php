<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategorRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface CategoryRepository extends RepositoryInterface
{
    public function model();
}
