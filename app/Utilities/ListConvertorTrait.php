<?php
declare(strict_types=1);

namespace App\Utilities;

use App\Exceptions\InvalidSourceException;

/**
 * Trait ListConvertorTrait
 */
trait ListConvertorTrait
{
    
    /**
     * Convert a list of records to array.
     * Output array is formed by columns (such as surname, given name etc.) of the list.
     * for example, sub-array of index 0 contains surnames,
     * index 1 contains the last given name, index 2 contains the second last given name, and so on and so forth ...
     *
     * @param string $unsortedList
     * The original unsorted list of row records, for example, each row represents a person's names.
     *
     * @return array
     * Two-dimensional array, formed by columns of the list, that is, sub-array of index 0 contains the first column of list, and so on.
     * for example, sub-array of index 0 contains all the surnames, sub-array of index 1 contains all the last given names, and so on.
     * @throws \App\Exceptions\InvalidSourceException
     */
    private function convertListToColumnArray(string $unsortedList): array
    {
        $columnsArray = [];
        
        $rows = explode("\n", trim($unsortedList));
        foreach ($rows as $row) {
            $rowArray = explode(' ', trim($row));
            if (false === $this->validateListRow($rowArray)) {
                throw new  InvalidSourceException('Each row of the list must have minimum 2 and maximum 4 columns.');
            }
    
            $rowArray = array_pad(
                array_reverse($rowArray),
                4,
                ''
            );
            array_walk(
                $rowArray, function ($column, $key) use (&$columnsArray) {
                /** @noinspection PhpArrayUsedOnlyForWriteInspection PHPStorm false warning */
                $columnsArray[$key] [] = $column;
            });
        }
        
        return $columnsArray;
    }
    
    /**
     * Convert an array composed by columns  to array composed of rows, that is, array of persons.
     *
     * @param $columnArray
     * A two-dimensional array, index 0 of each sub-array represents the first column of a list, and so on.
     *
     * @return array
     * Two-dimensional array, each sub-array represents one row's record, for example, a person's names.
     */
    private function arrayColumnToRow($columnArray): array
    {
        $rowArray = [];
        array_walk_recursive(
            $columnArray, function ($column, $key) use (&$rowArray) {
            /** @noinspection PhpArrayUsedOnlyForWriteInspection PHPStorm false warning */
            $rowArray[$key][] = $column;
        });
        
        return $rowArray;
    }
    
    /**
     * Convert sub-array of a two-dimensional array to space-separated string
     * (and the resulted array becomes one-dimensional)
     *
     * @param array $data
     * Two-dimensional array, each sub-array represents a row-record, for example, a person's names.
     * (It's not preferred to pass argument by reference - despite of legacy PHP internal functions doing that way)
     *
     * @return array
     * One-dimensional array, each item is a space-separated string, for example, a person's names as text.
     */
    private function stringifyRows(array $data): array
    {
        array_walk(
            $data, function (&$rowData) {
            $rowData = trim(implode(' ', $rowData));
        });
        
        return $data;
    }
    
    /**
     * @param array $data
     *
     * @return bool
     */
    private function validateListRow(array $data): bool
    {
        $length = \count($data);
        
        return $length >= 2 && $length <= 4;
    }
}
