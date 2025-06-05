<?php

namespace App\Kernel\Auth;

interface AuthInterface
{
public function attempt($username, $password):bool;
public function check():bool;
public function user(): ?User;
public function logout():void;
public function table(): string;
public function username(): string;
public function password(): string;
public function sessionField(): string;
}