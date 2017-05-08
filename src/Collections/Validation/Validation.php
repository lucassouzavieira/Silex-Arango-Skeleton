<?php
declare(strict_types=1);

namespace App\Collections\Validation;

/**
 * Interface Validation
 * Forces Repositories to implement a method to validate data
 * @package App\Collections\Validation
 */
interface Validation
{
    public function validate(array $input) : bool;
}
