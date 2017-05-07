<?php
declare(strict_types=1);

namespace App\Collections\Validation;

interface Validation
{
    public function validate(array $input) : bool;
}
