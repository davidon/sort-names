<?php
declare(strict_types=1);

namespace App;

/**
 * Class SortNames.
 */
class NamesSorter
{
    /**
     * @param string $unsortedNamesList
     *
     * @return string
     */
    public function sortNamesList(string $unsortedNamesList): string
    {
        $namesArray = $this->namesListToArrayByColumn($unsortedNamesList);
        $namesSorted = $this->sortNamesArray($namesArray);
        $rowsArray = $this->columnNamesToRows($namesSorted);
        $personAsStrArray = $this->personAsStrArray($rowsArray);
    
        return trim(implode(PHP_EOL, $personAsStrArray));
    }
    
    /**
     * Convert unsorted names list to array.
     * Output array is formed by columns (surname, last & 2nd-last given name etc.) of th list.
     * sub-array of index 0 contains surnames,
     * index 1 contains the last given name, index 2 contains the second last given name, and so on and so forth ...
     *
     * @param string $unsortedNamesList
     *
     * @return array
     */
    private function namesListToArrayByColumn(string $unsortedNamesList): array
    {
        $namesArray = [];
        
        $persons = explode("\n", trim($unsortedNamesList));
        foreach ($persons as $person) {
            $personArray = array_pad(
                array_reverse(explode(' ', trim($person))),
                4,
                ''
            );
            array_walk(
                $personArray, function ($name, $key) use (&$namesArray) {
                /** @noinspection PhpArrayUsedOnlyForWriteInspection PHPStorm false warning */
                $namesArray[$key] [] = $name;
            });
        }
        
        return $namesArray;
    }
    
    /**
     * Sort array of names, firstly sort by surname (sub-array of index 0), then sort by  given name of the last, 2nd last and so on.
     *
     * @param array $namesArray
     * It's not preferred to pass argument by reference (despite of legacy PHP internal functions doing that way)
     *
     * @return array
     */
    private function sortNamesArray(array $namesArray): array
    {
        array_multisort($namesArray[0], $namesArray[1], $namesArray[2], $namesArray[3]);
    
        return array_reverse($namesArray);
    }
    
    /**
     * Assemble names array of columns back to array of rows, that is, array of persons.
     * for example, array of Index 0 contains names of first sorted person, and so on.
     *
     * @param $namesArray
     *
     * @return array
     * Two-dimensional array, each item of first-dimension represents one person's names.
     */
    private function columnNamesToRows($namesArray): array
    {
        $namesSorted = [];
        array_walk_recursive(
            $namesArray, function ($name, $key) use (&$namesSorted) {
            /** @noinspection PhpArrayUsedOnlyForWriteInspection PHPStorm false warning */
            $namesSorted[$key][] = $name;
        });
    
        return $namesSorted;
    }
    
    /**
     * Convert array of a person's names to string.
     *
     * @param array $namesSorted
     * Two-dimensional array, each item of first-dimension represents one person's names.
     * It's not preferred to pass argument by reference (despite of legacy PHP internal functions doing that way)
     *
     * @return array
     * One-dimensional array, each item is one person's names as text.
     */
    private function personAsStrArray(array $namesSorted): array
    {
        array_walk(
            $namesSorted, function (&$personNames) {
            $personNames = trim(implode(' ', $personNames));
        });
        
        return $namesSorted;
    }
}




