<?php

namespace App\Http\Requests\Account\Contracts;

interface CreateClientModel
{
    public function getName(): string;

    public function getAddress1(): string;

    public function getAddress2(): string;

    public function getCity(): string;

    public function getState(): string;

    public function getCountry(): string;

    public function getZipCode(): string;

    public function getPhoneNo1(): string;

    public function getPhoneNo2(): string;
}
