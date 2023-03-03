<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewUserRequest;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     * @throws Exception
     */
    public function index(Request $request): View
    {
        $requester = $request->query->all();
        $users = $this->userService->search(requester: $requester);
        return view('admin.users.list', compact('users', 'requester'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(NewUserRequest $request) : RedirectResponse
    {
        $this->userService->create($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Create user successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->userService->find(id: $id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = $this->userService->find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $user = $this->userService->update(data: $request->all(), id: $id);
        return $user ? redirect()->route('admin.users.index')->with('Success', 'Update user successfully') : back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Model
     * @throws Exception
     */
    public function destroy(int $id): Model
    {
        return $this->userService->delete(id: $id);
    }
}
