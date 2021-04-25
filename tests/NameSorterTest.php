<?php
declare(strict_types=1);

namespace Tests;

use App\NamesSorter;
use App\MultiArraySorter;
use App\Transformer;
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
     *
     * Although the fixture has duplicate records for different test methods,
     * it's preferred to use the literal form rather than going through transformation.
     *
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
     * @var \App\NamesSorter
     */
    private NamesSorter $sorter;
    
    /**
     * setup to run before every test method.
     */
    protected function setUp(): void
    {
        $this->sorter = new NamesSorter(
            new MultiArraySorter(),
            new Transformer()
        );
        
        // This is to meet Liskov substitution principle, and also avoid PHPStorm warning.
        parent::setUp();
    }
    
    /**
     * Test sort names list
     * (using the original fixture).
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function testSortNamesList(): void
    {
        $result = $this->sorter->sortList(self::UNSORTED_NAMES_LIST);
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
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function testSortNamesListWithDuplicateSurnames(): void
    {
        $result = $this->sorter->sortList(
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
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function testSortNamesListWithDuplicateSurnamesGivenNames(): void
    {
        $result = $this->sorter->sortList(
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
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function testSortNamesListWithDuplicateSurnamesTwoGivenNames(): void
    {
        $result = $this->sorter->sortList(
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
    
    /**
     * Test sort names list with only one given name.
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function testSortNamesListWithOneGivenName(): void
    {
        $result = $this->sorter->sortList(
            <<<LIST
Janet Parsons
Vaughn Lewis
Waughn Lewis
Julius Archer
Nathan Yoder
Mathan Yoder
Marin Alvarez
London Lindsey
Tristan Bentley
Leo Gardner
Mathew Clarke
Nathew Clarke
Mikayla Lopez
Conner Ritter
LIST
        );
        self::assertSame(
        // Don't tab the names list;
        // Good practice for unit test doesn't transform the expected result in any way.
            <<<SORTED
Marin Alvarez
Julius Archer
Tristan Bentley
Mathew Clarke
Nathew Clarke
Leo Gardner
Vaughn Lewis
Waughn Lewis
London Lindsey
Mikayla Lopez
Janet Parsons
Conner Ritter
Mathan Yoder
Nathan Yoder
SORTED,
            $result
        );
    }
}
