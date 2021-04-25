<?php
declare(strict_types=1);

namespace Tests;

use App\Exceptions\InvalidSourceException;
use App\Transformer;
use PHPUnit\Framework\TestCase;

/**
 * Class TransformerTest.
 *
 * @covers \App\Transformer
 */
class TransformerTest extends TestCase
{
    /**
     * Unsorted names list.
     *
     * @const string
     */
    private const  UNSORTED_NAMES_LIST = <<<LIST
Janet Parsons
Adonis Julius Archer
Hunter Uriah Mathew Clarke
LIST;

    /**
     * @var \App\Transformer
     */
    private Transformer $transformer;
    
    /**
     * setup to run before every test method.
     */
    protected function setUp(): void
    {
        $this->transformer = new Transformer();
    
        // This is to meet Liskov substitution principle, and also avoid PHPStorm warning.
        parent::setUp();
    }
    
    /**
     * Test Transformer::toArray()
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function testToArray()
    {
        $actual = $this->transformer->toArray(self::UNSORTED_NAMES_LIST);
        self::assertSame(
            [
                ['Parsons', 'Archer', 'Clarke'],
                ['Janet', 'Julius', 'Mathew'],
                ['', 'Adonis', 'Uriah'],
                ['', '', 'Hunter']
            ],
            $actual
        );
    }
    
    /**
     * Test Transformer::toArray() with only one column in the list and causes exception.
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function  testToArrayOnlyOneNameException()
    {
        $this->expectException(InvalidSourceException::class);
        $this->transformer->toArray(
            <<<LIST
Janet
Adonis Julius Archer
Hunter Uriah Mathew Clarke
LIST
        );
    }
    
    /**
     * Test Transformer::toArray() with five columns in the list and causes exception.
     *
     * @throws \App\Exceptions\InvalidSourceException
     */
    public function  testToArrayFiveNamesException()
    {
        $this->expectException(InvalidSourceException::class);
        $this->transformer->toArray(
            <<<LIST
Janet
Adonis Julius Archer
London Hunter Uriah Mathew Clarke
LIST
        );
    }
}
