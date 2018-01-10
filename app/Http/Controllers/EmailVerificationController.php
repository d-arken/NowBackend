<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Jrean\UserVerification\Traits\VerifiesUsers;

class EmailVerificationController extends Controller
{

    use VerifiesUsers;
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('admin.home.index');
    }

    public function loginUser(){
        $email = \Request::get('email');
        $user = $this->repository->findByField('email',$email)->first();
        \Auth::login($user);
    }

}
