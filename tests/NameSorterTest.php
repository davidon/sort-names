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
     * Test sort names list
     * (using the original fixture).
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
    
    /**
     * Test sort names list with duplicate surnames.
     */
    public function testSortNamesListWithDuplicateSurnames(): void
    {
        $sorter = new NamesSorter();
        $result = $sorter->sortNamesList(
            <<<LIST
Janet Parsons
Vaughn Lewis
Waughn Lewis
Adonis Julius Archer
Shelby Nathan Yoder
Shelby Mathan Yoder
Marin Alvarez
London Lindsey
Beau Tristan Bentley
Leo Gardner
Hunter Uriah Mathew Clarke
Hunter Uriah Nathew Clarke
Mikayla Lopez
Frankie Conner Ritter
LIST
        );
        self::assertSame(
        // Don't tab the names list;
        // Good practice for unit test doesn't transform the expected result in any way.
            <<<SORTED
Marin Alvarez
Adonis Julius Archer
Beau Tristan Bentley
Hunter Uriah Mathew Clarke
Hunter Uriah Nathew Clarke
Leo Gardner
Vaughn Lewis
Waughn Lewis
London Lindsey
Mikayla Lopez
Janet Parsons
Frankie Conner Ritter
Shelby Mathan Yoder
Shelby Nathan Yoder
SORTED,
            $result
        );
    }
    
    /**
     * Test sort names list with duplicate surnames and given names.
     */
    public function testSortNamesListWithDuplicateSurnamesGivenNames(): void
    {
        $sorter = new NamesSorter();
        $result = $sorter->sortNamesList(
            <<<LIST
Janet Parsons
Vaughn Lewis
Vaugho Lewis
Adonis Julius Archer
Shelby Nathan Yoder
Thelby Nathan Yoder
Marin Alvarez
London Lindsey
Beau Tristan Bentley
Leo Gardner
Hunter Uriah Mathew Clarke
Hunter Triah Mathew Clarke
Mikayla Lopez
Frankie Conner Ritter
LIST
        );
        self::assertSame(
        // Don't tab the names list;
        // Good practice for unit test doesn't transform the expected result in any way.
            <<<SORTED
Marin Alvarez
Adonis Julius Archer
Beau Tristan Bentley
Hunter Triah Mathew Clarke
Hunter Uriah Mathew Clarke
Leo Gardner
Vaughn Lewis
Vaugho Lewis
London Lindsey
Mikayla Lopez
Janet Parsons
Frankie Conner Ritter
Shelby Nathan Yoder
Thelby Nathan Yoder
SORTED,
            $result
        );
    }
    
    /**
     * Test sort names list with duplicate surnames and two given names.
     */
    public function testSortNamesListWithDuplicateSurnamesTwoGivenNames(): void
    {
        $sorter = new NamesSorter();
        $result = $sorter->sortNamesList(
            <<<LIST
Janet Parsons
Vaughn Lewis
Vaugho Lewis
Adonis Julius Archer
Shelby Nathan Yoder
Shelbi Nathan Yoder
Marin Alvarez
London Lindsey
Beau Tristan Bentley
Leo Gardner
Hunter Triah Mathew Clarke
Tunter Triah Mathew Clarke
Mikayla Lopez
Frankie Conner Ritter
LIST
        );
        self::assertSame(
        // Don't tab the names list;
        // Good practice for unit test doesn't transform the expected result in any way.
            <<<SORTED
Marin Alvarez
Adonis Julius Archer
Beau Tristan Bentley
Hunter Triah Mathew Clarke
Tunter Triah Mathew Clarke
Leo Gardner
Vaughn Lewis
Vaugho Lewis
London Lindsey
Mikayla Lopez
Janet Parsons
Frankie Conner Ritter
Shelbi Nathan Yoder
Shelby Nathan Yoder
SORTED,
            $result
        );
    }
}
