<?php

declare(strict_types=1);

namespace tests\Phpml\Math;

use Phpml\Math\Comparison;
use PHPUnit\Framework\TestCase;

class ComparisonTest extends TestCase
{
    /**
     * @param mixed  $a
     * @param mixed  $b
     * @param string $operator
     * @param bool   $expected
     *
     * @dataProvider provideData
     */
    public function testResult($a, $b, string $operator, bool $expected)
    {
        $result = Comparison::compare($a, $b, $operator);

        $this->assertEquals($expected, $result);
    }

    /**
    * @expectedException \Phpml\Exception\InvalidArgumentException
    * @expectedExceptionMessage Invalid operator "~=" provided
    */
    public function testThrowExceptionWhenOperatorIsInvalid()
    {
        Comparison::compare(1, 1, '~=');
    }

    /**
     * @return array
     */
    public function provideData()
    {
        return [
            // Greater
            [1, 0, '>', true],
            [1, 1, '>', false],
            [0, 1, '>', false],
            // Greater or equal
            [1, 0, '>=', true],
            [1, 1, '>=', true],
            [0, 1, '>=', false],
            // Equal
            [1,   0,  '=', false],
            [1,   1, '==', true],
            [1, '1',  '=', true],
            [1, '0', '==', false],
            // Identical
            [1,     0, '===', false],
            [1,     1, '===', true],
            [1,   '1', '===', false],
            ['a', 'a', '===', true],
            // Not equal
            [1,   0, '!=', true],
            [1,   1, '<>', false],
            [1, '1', '!=', false],
            [1, '0', '<>', true],
            // Not identical
            [1,   0, '!==', true],
            [1,   1, '!==', false],
            [1, '1', '!==', true],
            [1, '0', '!==', true],
            // Less or equal
            [1, 0, '<=', false],
            [1, 1, '<=', true],
            [0, 1, '<=', true],
            // Less
            [1, 0, '<', false],
            [1, 1, '<', false],
            [0, 1, '<', true],
        ];
    }
}
