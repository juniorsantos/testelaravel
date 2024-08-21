<?php

namespace App\DTOs\Api\V1\Auth;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class RegisterDTO extends ValidatedDTO
{
    public string $full_name;
    public string $email;
    public string $password;
    public string $postalCode;
    public string $street;
    public string $number;
    public string $district;
    public string $city;
    public string $state;

    protected function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'postal_code' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ];
    }

    protected function defaults(): array
    {
        return [
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
