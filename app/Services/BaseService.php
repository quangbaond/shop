<?php
namespace App\Services;

use App\Repositories\Eloquent\BaseRepository;
use Exception as ExceptionAlias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BaseService
{
    /**
     * @var BaseRepository
     */
    public $repository;
    /**
     * BaseService constructor.
     *
     * @param BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->repository->create($attributes);
    }
    /**
     * @param $id
     * @return Model
     */
    public function find($id) :Model
    {
        return $this->repository->find($id);
    }
    /**
     * @param $limit
     * @return Model
     */
    public function pagination($limit): Object
    {
        return $this->repository->pagination($limit);
    }

    /**
     * @param $id
     * @return Model
     * @throws ExceptionAlias
     */
    public function delete($id) :Model
    {
        $user = $this->find($id);
        return $user->delete($user);
    }
}

