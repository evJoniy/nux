<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\LinkServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __construct(
        private LinkServiceInterface $linkService,
        private UserServiceInterface $userService
    ) {
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->findOrCreate($request->only('username', 'mobile'));
        $link = $this->linkService->findOrCreate($user->getId())->getToken();

        return redirect()->back()->with('success', 'Registration successful!')->with('token', $link);
    }
}
