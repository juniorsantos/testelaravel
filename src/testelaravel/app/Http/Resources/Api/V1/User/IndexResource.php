<?php

namespace App\Http\Resources\Api\V1\User;

use App\Enums\Api\V1\Auth\RolesEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method hasRole(RolesEnum $ADMIN)
 */
class IndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'user',
            'id' => $this->ulid,
            'attributes' => [
                'name' => $this->full_name,
                'suite' => $this->suite,
                'email' => $this->email,
                'phone' => $this->phone,
                'isAdmin' => $this->hasRole(RolesEnum::ADMIN),
                'emailVerifiedAt' => (bool) $this->email_verified_at,
                'createdAt' => $this->created_at->format('Y-m-d H:i'),
            ],
            'links' => [
                'self' => route('users.show', ['user' => $this->ulid]),
            ],
        ];
    }
}
