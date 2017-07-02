<?php

declare(strict_types = 1);

namespace Puzzle\QueryBuilder\Conditions;

use Puzzle\QueryBuilder\Escaper;
use Puzzle\QueryBuilder\Type;

abstract class AbstractNullComparisonCondition extends AbstractCondition
{
    private
        $column;

    public function __construct($column)
    {
        if($column instanceof Type)
        {
            $column = $column->getName();
        }

        $this->column = (string) $column;
    }

    public function toString(Escaper $escaper): string
    {
        if(empty($this->column))
        {
            return '';
        }

        return sprintf('%s %s',
            $this->column,
            $this->getOperator()
        );
    }

    public function isEmpty(): bool
    {
        return empty($this->column);
    }

    abstract protected function getOperator(): string;
}
