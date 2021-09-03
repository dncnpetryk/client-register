<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Account\Contracts\CreateClientModel;
use App\Http\Requests\Account\Contracts\CreateUserModel;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest implements CreateClientModel, CreateUserModel
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'address1' => [
                'required',
                'string',
            ],
            'address2' => [
                'required',
                'string',
            ],
            'city' => [
                'required',
                'string',
                'max:100',
            ],
            'state' => [
                'required',
                'string',
                'max:100',
            ],
            'country' => [
                'required',
                'string',
                'max:100',
            ],
            'zipCode' => [
                'required',
                'integer',
            ],
            'phoneNo1' => [
                'required',
                'string',
                'max:20',
            ],
            'phoneNo2' => [
                'required',
                'string',
                'max:20',
            ],
            'user.firstName' => [
                'required',
                'string',
                'max:50',
            ],
            'user.lastName' => [
                'required',
                'string',
                'max:50',
            ],
            'user.email' => [
                'required',
                'unique:users,email',
                'string',
                'max:150',
            ],
            'user.password' => [
                'required',
                'string',
                'max:256',
            ],
            'user.phone' => [
                'required',
                'string',
                'max:20',
            ],
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getAddress1(): string
    {
        return $this->input('address1');
    }

    public function getAddress2(): string
    {
        return $this->input('address2');
    }

    public function getCity(): string
    {
        return $this->input('city');
    }

    public function getState(): string
    {
        return $this->input('state');
    }

    public function getCountry(): string
    {
        return $this->input('country');
    }

    public function getZipCode(): string
    {
        return $this->input('zipCode');
    }

    public function getPhoneNo1(): string
    {
        return $this->input('phoneNo1');
    }

    public function getPhoneNo2(): string
    {
        return $this->input('phoneNo2') ?? '';
    }

    public function getFirstName(): string
    {
        return $this->input('user.firstName');
    }

    public function getLastName(): string
    {
        return $this->input('user.lastName');
    }

    public function getEmail(): string
    {
        return $this->input('user.email');
    }

    public function getPassword(): string
    {
        return $this->input('user.password');
    }

    public function getPhone(): string
    {
        return $this->input('user.phone');
    }
}
