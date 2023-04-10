<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use App\Http\Requests\DTO\User\UserCreateRequest;
use App\Http\Requests\DTO\User\UserGetRequest;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function __construct(
        protected UserServiceInterface $userService,

    )
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.users.create');
    }

    /**
     * @return View
     */
    public function show(): View
    {
        return view('pages.users.show');
    }

    /**
     * @param UserGetRequest $request
     * @return View
     */
    public function getUserByMail(UserGetRequest $request): View
    {
        try {
            $user = $this->userService->get($request);
            return view('pages.users.index', ['user' => $user]);
        } catch (Exception $e) {
            return view('errors.user.user_errors', ['message' => $e->getMessage()]);
        }

    }


    /**
     * @throws Exception
     */

    public function store(UserCreateRequest $request): string
    {
        try {

        $this->userService->store($request);
        } catch (Exception $e) {
            return view('errors.user.user_errors', ['message' => $e->getMessage()]);

        }

        Queue::later(10, function () {
            Session::forget('success');
        });
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'User created successfully.');
    }



}
