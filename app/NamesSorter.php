<?php
declare(strict_types=1);

namespace App;

use App\Interfaces\NamesSorterInterface;
use App\Interfaces\SorterCoreInterface;
use App\Interfaces\TransformerInterface;
use App\Utilities\ListConvertorTrait;

/**
 * Class SortNames.
 */
class NamesSorter implements NamesSorterInterface
{
    use ListConvertorTrait;
    
    /**
     * @var \App\Interfaces\SorterCoreInterface
     */
    private SorterCoreInterface $sorterCore;
    
    /**
     * @var \App\Interfaces\TransformerInterface
     */
    private TransformerInterface $transformer;
    
    /**
     * NamesSorter constructor.
     *
     * Inject the sorting core interface and list/array transformer interface in order to easily apply other algorithms.
     * This way conforms to Dependency Inversion principle, and "Open/closed" principle of S.O.L.I.D.
     *
     * @param \App\Interfaces\SorterCoreInterface $sorterCore
     * @param \App\Interfaces\TransformerInterface $transformer
     */
    public function __construct(SorterCoreInterface $sorterCore, TransformerInterface $transformer)
    {
        $this->sorterCore = $sorterCore;
        $this->transformer = $transformer;
    }
    
    /**
     * Sort names list.
     *
     * Steps:
     * - Convert unsorted names list to array.
     *   Output array is formed by columns (surname, last & 2nd-last given name etc.) of th list.
     *   sub-array of index 0 contains surnames,
     *   index 1 contains the last given name, index 2 contains the second last given name, and so on and so forth.
     *
     * - Sort array of names, firstly sort by surname (sub-array of index 0), then sort by  given name of the last, 2nd last and so on.
     *
     * - Assemble names array of columns back to array of rows,
     *   that is, each sub-array of result represents one person's names.
     *   for example, array of Index 0 contains names of first sorted person, and so on.
     *   The source and target arrays are both two-dimensional.
     *
     * - Convert each sub-array of a person's names to string.
     *   The result is an one-dimensional array, each item represents one person's names as text.
     *
     * @param string $unsortedNamesList
     *
     * @return string
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function sortList(string $unsortedNamesList): string
    {
        return $this->transformer->stringify(
            $this->sorterCore->sortArray(
                $this->transformer->toArray($unsortedNamesList)
        ));
    }
}



