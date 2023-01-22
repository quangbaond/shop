<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * $newRepository constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }

    /**
     * @param $slug
     * @return Model
     */
    public function findBySlug($slug): Model
    {
        return $this->newRepository->findBySlug($slug);
    }

    /**
     * @param int $limit
     * @param string[] $columns
     * @return LengthAwarePaginator
     */
    public function search(int $limit = PAGINATE_DEFAULT, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->userRepository->search($limit, $columns);
    }
}
