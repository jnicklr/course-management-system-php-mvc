<?php

namespace App\Infrastructure\Http\Controllers;

use Framework\Controller;
use Framework\Response;
use Framework\Validator;
use Framework\Responses\RedirectResult;
use Framework\Responses\OkResult;
use Framework\Responses\ViewResult;
use Framework\Responses\CreatedResult;
use App\Domain\Entities\User;
use App\Infrastructure\Http\Services\UserService;
use App\Infrastructure\Exceptions\ExceptionHandler;
use Framework\Exceptions\UnauthorizedException;

class UserController extends Controller
{
    private UserService $_service;

    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }

    public function signInView(): Response
    {
        return (new ViewResult('login'))->toResponse();
    }

    public function login(): Response
    {
        try {
            $data = $this->request->post;

            $validator = new Validator([
                'email' => $data["email"] ?? "",
                'password' => $data["password"] ?? ""
            ], [
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $validator->validate();

            $isSignedIn = $this->_service->login($data["email"], $data["password"]);

            if (!$isSignedIn){
                throw new UnauthorizedException("Login was unsuccessful!");
            } 

            $_SESSION['logado'] = true;

            return (new OkResult([], "Login was successful!", ["Content-Type: application/json"]))->toResponse();
        } catch (\Throwable $e){
            return (ExceptionHandler::handle($e))->toResponse();
        }
    }

    public function signUpView(): Response
    {
        return (new ViewResult('register'))->toResponse();
    }

    public function register(): Response
    {
        try {
            $data = $this->request->post;

            $validator = new Validator([
                'name' => $data["name"] ?? "",
                'email' => $data["email"] ?? "",
                'password' => $data["password"] ?? ""
            ], [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $validator->validate();

            $user = new User();
            $user->setName($data["name"]);
            $user->setPassword($data["password"]);
            $user->setEmail($data["email"]);

            $isSignedUp = $this->_service->register($user);

            if (!$isSignedUp){
                throw new UnauthorizedException("Registration was unsuccessful!");
            }

            return (new CreatedResult([], "Registration was successful!", ["Content-Type: application/json"]))->toResponse();
        } catch (\Throwable $e){
            return (ExceptionHandler::handle($e))->toResponse();
        }
    }
}