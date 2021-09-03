<?php

namespace App\Http\Requests\Account\Contracts;

interface CreateUserModel
{
    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;

    public function getPassword(): string;

    public function getPhone(): string;
}
