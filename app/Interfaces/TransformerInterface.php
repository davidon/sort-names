<?php
declare(strict_types=1);

namespace App\Interfaces;

/**
 * Interface TransformerInterface.
 */
interface TransformerInterface
{
    /**
     * Convert a list (e.g. names) to array.
     *
     * @param string $listStr
     *
     * @return array
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function toArray(string $listStr): array;
    
    /**
     * Convert an array to a list of string.
     *
     * @param array $listArray
     *
     * @return string
     */
    public function stringify(array $listArray): string;
}
