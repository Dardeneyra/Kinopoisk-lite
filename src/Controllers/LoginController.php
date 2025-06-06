<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
public function index()
{
    $this->view('login');
}

public function login()
{
$email = $this->request()->input('email');
$password = $this->request()->input('password');

$this->auth()->attempt($email, $password);

$this->redirect('/home');
}

public function logout(): null
{
    $this->auth()->logout();

    return $this->redirect('/login');
}
}