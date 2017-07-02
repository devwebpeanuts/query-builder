<?php

declare(strict_types = 1);

namespace Puzzle\QueryBuilder\Queries\Snippets;

use PHPUnit\Framework\TestCase;

class FromTest extends TestCase
{
    /**
     * @dataProvider providerTestFrom
     */
    public function testFrom($expected, $tableName, $alias)
    {
        $qb = new From($tableName, $alias);

        $this->assertSame($qb->toString(), $expected);
    }

    public function providerTestFrom()
    {
        return array(
            'String table name' => array('FROM poney', 'poney', null),
            'Mixed table name'  => array('FROM poney666', 'poney666', null),
            'wrapped with 0'    => array('FROM 000poney000', '000poney000', null),
            'empty alias'        => array('FROM poney', 'poney', ''),
            'with alias'        => array('FROM poney AS p', 'poney', 'p'),
        );
    }

    public function testFromUsingTableNamePart()
    {
        $tableName = new TableName('unicorns', 'u');

        $qb = new From($tableName);

        $this->assertSame($qb->toString(), 'FROM unicorns AS u');
    }

    /**
     * @dataProvider providerTestEmptyTableName
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyTableName($tableName)
    {
        $qb = new From($tableName);

        $qb->toString($tableName);
    }

    public function providerTestEmptyTableName()
    {
        return array(
            'empty table name' => array(''),
            'null table name' => array(null),
        );
    }
}