<?php
declare(strict_types=1);

namespace App\Interfaces;

/**
 * Interface SorterCoreInterface.
 * This is to make core sorting logic abstract so as to use different algorithms to sort.
 */
interface SorterCoreInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function sortArray(array $data): array;
}
