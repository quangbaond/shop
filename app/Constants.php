<?php
const ROUTE_ADMIN_REDIRECT = '/admin';
const CLASS_NAME_ACTIVE = 'success';
const CLASS_NAME_INACTIVE = 'danger';
const STATUS_INACTIVE = 0;
const STATUS_ACTIVE = 1;
const PAGINATE_DEFAULT = 10;
const ARRAY_LIMIT = [10, 20, 30, 40, 50];
const ARRAY_STATUS = [STATUS_ACTIVE => 'Hoạt động', STATUS_INACTIVE => 'Ngừng hoạt động'];

const ARRAY_ORDER_BY_USER = [
    'name' => 'Tên',
    'email' => 'Email',
    'created_at' => 'Ngay tạo',
    'updated_at' => 'Ngày cập nhật',
    'address' => 'Địa chỉ',
    'number_phone' => 'Số điện thoại',
];

