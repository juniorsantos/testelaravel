<?php

namespace App\Http\Resources\Api\V1\User;

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
            'id' => $this->ulid,
            'name' => $this->full_name,
            'email' => $this->email,
            'emailVerifiedAt' => (bool)$this->email_verified_at,
            'createdAt' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
