<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param array $requester
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function search(array $requester = []): LengthAwarePaginator
    {
        $columnCanSearchKeyword = ['name', 'email', 'username', 'address', 'number_phone', 'created_at', 'updated_at'];
        $limit = $requester['limit'] ?? PAGINATE_DEFAULT;
        return $this->userRepository->pagination(limit: $limit, requester: $requester, columnCanSearchKeyword: $columnCanSearchKeyword);
    }

}
