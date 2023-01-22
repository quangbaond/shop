<?php
/*
 * Admin breadcrumbs
 */
// Home
Breadcrumbs::for('admin_home', function ($trail) {
    $trail->push(__('Dashboard'), route('admin.index'));
});
// Home/users
Breadcrumbs::for('admin_user_list', function ($trail) {
    $trail->parent('admin_home');
    $trail->push(__('sidebar.userList'), route('admin.index'));
});
// Home/users/user_info.
Breadcrumbs::for('admin_user_edit', function ($trail, $user) {
    $trail->parent('admin_user_list');
    $trail->push($user, route('admin.users.edit', $user));
});
