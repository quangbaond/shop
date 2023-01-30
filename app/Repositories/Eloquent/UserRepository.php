<?php

namespace App\Repositories\Eloquent;
use Exception;
use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function update(array $data, int $id): bool
    {
        $model = $this->find($id);
        if(isset($data['avatar'])) {
            if(!is_file($data['avatar'])) throw new Exception('File not found');
            $data['avatar'] = $this->uploadFileStorage(path: 'avatars', file: $data['avatar']);
        }
        return $model->update($data);
    }

}
