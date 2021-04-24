<?php
declare(strict_types=1);

namespace App;

use App\Interfaces\NamesSorterInterface;
use App\Utilities\ListConvertorTrait;

/**
 * Class SortNames.
 */
class NamesSorter implements NamesSorterInterface
{
    use ListConvertorTrait;
    
    /**
     * @param string $unsortedNamesList
     *
     * @return string
     */
    public function sortNamesList(string $unsortedNamesList): string
    {
        // Convert unsorted names list to array.
        // Output array is formed by columns (surname, last & 2nd-last given name etc.) of th list.
        // sub-array of index 0 contains surnames,
        // index 1 contains the last given name, index 2 contains the second last given name, and so on and so forth.
        $namesArray = $this->convertListToColumnArray($unsortedNamesList);
       
        // Sort array of names, firstly sort by surname (sub-array of index 0), then sort by  given name of the last, 2nd last and so on.
        $namesSorted = array_reverse(
            $this->sortArrayByColumns($namesArray)
        );
        
        // Assemble names array of columns back to array of rows,
        // that is, each sub-array of result represents one person's names.
        // for example, array of Index 0 contains names of first sorted person, and so on.
        // The source and target arrays are both two-dimensional.
        $rowsArray = $this->convertColumnArrayToRowArray($namesSorted);
        
        // Convert each sub-array of a person's names to string.
        // The result is an one-dimensional array, each item represents one person's names as text.
        $personAsStrArray = $this->convertRowToStrArray($rowsArray);
    
        return trim(implode(PHP_EOL, $personAsStrArray));
    }
}




