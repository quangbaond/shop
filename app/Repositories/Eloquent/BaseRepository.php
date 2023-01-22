<?php
namespace App\Repositories\Eloquent;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model
     */
    public Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->model->find($id) ?? abort(404);
    }

    /**
     * @param int $limit
     * @return Model
     */
    public function pagination(int $limit = PAGINATE_DEFAULT) :Object
    {
        return $this->model->paginate($limit);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->model->find($id);
        return $this->model->delete($model);
    }


    /**
     * @param string $slug
     * @return Model
     */
    public function findBySlug(string $slug): Model
    {
        return $this->model->where('slug', $slug)->first();
    }
}
