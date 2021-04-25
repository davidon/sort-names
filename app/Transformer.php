<?php
declare(strict_types=1);

namespace App;

use App\Interfaces\TransformerInterface;
use App\Utilities\ListConvertorTrait;

/**
 * Class Transformer.
 */
class Transformer implements TransformerInterface
{
    use ListConvertorTrait;
    
    /**
     * Convert unsorted names list to array.
     * Output array is formed by columns (surname, last & 2nd-last given name etc.) of th list.
     * sub-array of index 0 contains surnames,
     * index 1 contains the last given name, index 2 contains the second last given name, and so on and so forth.
     *
     * @param string $listStr
     *
     * @return array
     */
    public function toArray(string $listStr): array
    {
        return $this->convertListToColumnArray($listStr);
    }
    
    /**
     * Convert array to list of string.
     *
     * Steps:
     * - Assemble names array of columns back to array of rows,
     * that is, each sub-array of result represents one person's names.
     * for example, array of Index 0 contains names of first sorted person, and so on.
     * The source and target arrays are both two-dimensional.
     *
     * - Convert each sub-array of a person's names to string.
     * The result is an one-dimensional array, each item represents one person's names as text.
     *
     * @param array $listArray
     *
     * @return string
     */
    public function stringify(array $listArray): string
    {
        return trim(implode(
            PHP_EOL,
            $this->stringifyRows(
                $this->arrayColumnToRow($listArray)
            )
        ));
    }
}
