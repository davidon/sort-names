<?php
declare(strict_types=1);

namespace App\Interfaces;

/**
 * Interface TransformerInterface.
 */
interface TransformerInterface
{
    public function toArray(string $listStr): array;
    public function stringify(array $listArray): string;

}
