<?php
declare(strict_types=1);

namespace App\Interfaces;

/**
 * Interface NamesSorterInterface
 */
interface NamesSorterInterface
{
    /**
     * Sort names list.
     *
     * @param string $unsortedNamesList
     *
     * @return string
     */
    public function sortNamesList(string $unsortedNamesList): string;
}
