<?php

namespace App\DTOs\Api\V1\Auth;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ResetPasswordDTO extends ValidatedDTO
{
    public string $token;
    public string $email;
    public string $password;

    protected function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
