<?php

declare(strict_types = 1);

namespace Puzzle\QueryBuilder\Queries\Snippets;

use PHPUnit\Framework\TestCase;

class GroupByTest extends TestCase
{
    /**
     * @dataProvider providerTestGroupBy
     */
    public function testGroupBy($expected, array $groupBy)
    {
        $qb = new GroupBy();

        foreach($groupBy as $column)
        {
            $qb->addGroupBy($column);
        }

        $this->assertSame($expected, $qb->toString());
    }

    public function providerTestGroupBy()
    {
        return array(
            'single column' => array('GROUP BY burger', ['burger']),
            'single column, empty column name' => array('', ['']),
            'single column, null column name' => array('', [null]),

            'multiple column' => array('GROUP BY burger, poney, id', ['burger', 'poney', 'id']),
            'multiple column, empty column name' => array('GROUP BY burger, id', ['burger', '', 'id']),
            'multiple column, null column name' => array('GROUP BY burger, id', ['burger', null, 'id']),
        );
    }
}