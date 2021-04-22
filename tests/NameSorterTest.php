<?php

declare(strict_types=1);

namespace Tests;

use App\NamesSorter;
use PHPUnit\Framework\TestCase;

/**
 * Class NameSorterTest.
 *
 * @covers \App\NamesSorter
 */
class NameSorterTest extends TestCase
{
    /**
     * Unsorted names list.
     * @const string
     */
    private const  UNSORTED_NAMES_LIST = <<<LIST
Janet Parsons
Vaughn Lewis
Adonis Julius Archer
Shelby Nathan Yoder
Marin Alvarez
London Lindsey
Beau Tristan Bentley
Leo Gardner
Hunter Uriah Mathew Clarke
Mikayla Lopez
Frankie Conner Ritter
LIST;
    
    /**
     * Test sort names list.
     */
    public function testSortNamesList(): void
    {
        $sorter = new NamesSorter();
        $result = $sorter->sortNamesList(self::UNSORTED_NAMES_LIST);
        self::assertSame(
            // Don't tab the names list;
            // Good practice for unit test doesn't transform the expected result in any way.
            <<<SORTED
Marin Alvarez
Adonis Julius Archer
Beau Tristan Bentley
Hunter Uriah Mathew Clarke
Leo Gardner
Vaughn Lewis
London Lindsey
Mikayla Lopez
Janet Parsons
Frankie Conner Ritter
Shelby Nathan Yoder
SORTED,
            $result
        );
    }
}
