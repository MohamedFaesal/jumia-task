<?php

namespace App\Entities;

class Customer extends Entity
{
    public int $id;
    public string $name;
    public string $country;
    public string $phone;
    public string $phoneNumber;
    public string $phoneCode;
    public bool $isValid;

}