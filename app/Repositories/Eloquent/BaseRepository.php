<?php
namespace App\Repositories\Eloquent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
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
     * @param array $requester
     * @param array $columnCanSearchKeyword
     * @return LengthAwarePaginator|null
     */
    public function pagination(int $limit = PAGINATE_DEFAULT, array $requester = [], array $columnCanSearchKeyword = []): LengthAwarePaginator|null
    {
        try {
            return $this->search($requester, $columnCanSearchKeyword)->paginate($limit);
        } catch (\Exception $e) {
            return null;
        }
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
     * @param array $requester
     * @param array $columnCanSearchKeyword
     * @return Builder
     */
    public function search(array $requester = [], array $columnCanSearchKeyword = []): Builder
    {
        $query = $this->model->query();
        collect($requester)->each(
            callback: fn($value, $key) => match ($key) {
            'keyword' => $query->when(
                value: $value,
                callback: fn($query)
                => $query->where(
                    fn($query) =>
                    collect($columnCanSearchKeyword)->each(
                        callback: fn($valueColumn) => $query->orWhere($valueColumn, 'like', "%$value%")),
                )
            ),
            'orderByColumn' => collect($value)->each(callback: fn($val, $k) => $query->orderBy(column: $k, direction: $val)),
            'orderBy', 'page' => $query,
            'limit' => $query->limit(value: $value),
            default => $query->when(
                value: $value,
                callback: fn($query) => $query->where($key, $value),
                default: fn($query) => $query->where($key, '!=', null),
            ),
        });
        return $query;
    }
}
