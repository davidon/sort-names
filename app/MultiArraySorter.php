<?php
declare(strict_types=1);

namespace App;

/**
 * Class MultiArraySorter.
 */
class MultiArraySorter implements Interfaces\SorterCoreInterface
{
    
    /**
     * Sort a two-dimensional array, firstly sort by sub-array of index 0, then by sub-array of index 1 and so on.
     * Assume the array to be sorted has maximum four columns, and minimum two columns.
     *
     * @param array $data
     * Two-dimensional array, formed by columns of the list, that is, sub-array of index 0 contains the first column of list, and so on.
     * (It's not preferred to pass argument by reference - despite of legacy PHP internal functions doing that way)
     *
     * @return array
     * Sorted array, still two-dimensional
     */
    public function sortArray(array $data): array
    {
        // each parameter must use $data[N], it can't be transformed in any way.
        array_multisort($data[0], $data[1], $data[2], $data[3]);
    
        return array_reverse($data);
    }
}
