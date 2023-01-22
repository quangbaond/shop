<?php

namespace App\Helpers;

class HelperUi
{
    /**
     * Display status of user
     *
     * @param $user
     * @return array
     */
     public static function showStatusUser($user): array
    {
        $className = '';
        $statusName = '';
        if($user) {
            $status = $user->status;
            if($status == STATUS_ACTIVE) {
                $className = CLASS_NAME_ACTIVE;
                $statusName = __('app.active');
            } else {
                $className = CLASS_NAME_INACTIVE;
                $statusName = __('app.inactive');
            }
        }
        return [
            'status_name' => $statusName,
            'class_name' => $className,
        ];
    }
}
