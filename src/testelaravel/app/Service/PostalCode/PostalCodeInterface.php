<?php

namespace App\Service\PostalCode;

interface PostalCodeInterface
{
    public function requestPostalCode(string $postalCode);
}
