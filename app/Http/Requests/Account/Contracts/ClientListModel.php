<?php

namespace App\Http\Requests\Account\Contracts;

interface ClientListModel
{
    public function getId(): ?int;

    public function getName(): ?string;

    public function getAddress1(): ?string;

    public function getAddress2(): ?string;

    public function getCity(): ?string;

    public function getState(): ?string;

    public function getCountry(): ?string;

    public function getZipCode(): ?string;

    public function getLatitude(): ?float;

    public function getLongitude(): ?string;

    public function getPhoneNo1(): ?string;

    public function getPhoneNo2(): ?string;

    public function getStatus(): ?string;

    public function getStartValidity(): ?string;

    public function getEndValidity(): ?string;

    public function getCreatedAt(): ?string;

    public function getUpdateAt(): ?string;

    public function getSort(): string;

    public function getOrder(): string;
}
