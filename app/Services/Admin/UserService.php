<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Repositories\Eloquent\UserRepository;

class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * $userRepository constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $limit
     * @param string[] $columns
     * @return object|array
     */
    public function search(int $limit = PAGINATE_DEFAULT, array $columns = ['*']): object|array
    {
        $columnCanSearchKeyword = ['name', 'email', 'username', 'address', 'number_phone', 'created_at', 'updated_at'];
        return $this->userRepository->pagination($limit, $columns, $columnCanSearchKeyword) ?? [];
    }
}
