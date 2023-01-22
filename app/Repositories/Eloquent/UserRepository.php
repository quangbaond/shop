<?php

namespace App\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * NewRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    /**
     * @param int $limit
     * @param array $requester
     * @return LengthAwarePaginator
     */
    public function search(int $limit, array $requester): LengthAwarePaginator
    {
        $query = $this->model->query();
        collect($requester)->each(callback: fn($value, $key) => $query = match ($key) {
            'keyword' => $query->when($value, function ($query) use ($value) {
                return $query->where(function ($query) use ($value) {
                    return $query->where('name', 'like', "%$value%")
                        ->orWhere('email', 'like', "%$value%")
                        ->orWhere('username', 'like', "%$value%")
                        ->orWhere('address', 'like', "%$value%")
                        ->orWhere('number_phone', 'like', "%$value%");
                });
            }),
            'orderByColumn' => collect($value)->each(callback: fn($val, $k) => $query = match ($k) {
                'name' => $query->orderBy('name', $requester['orderBy'] ?? 'asc'),
                default => $query->orderBy($val, $requester['orderBy'] ?? 'asc'),
            }),
            'orderBy', 'page' => $query,
            'status' => $query->when(!is_null($value), fn($query) => $query->where('status', $value)),
            'limit' => $query->limit($value),
            default => $query->where($key, $value),
        });
        return $query->paginate($limit);
    }
}
