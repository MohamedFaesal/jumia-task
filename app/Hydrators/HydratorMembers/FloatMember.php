<?php

namespace App\Hydrators\HydratorMembers;

use App\Hydrators\Abstracts\AbstractMember;

class FloatMember extends AbstractMember
{
    /**
     * @var string specified to get the element from the data source array
     */
    private $key;

    /**
     * FloatMember constructor.
     * @param string $key field name wanted to cast
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     * @return float|int
     */
    public function hydrate($row)
    {
        if (isset($row->{$this->key})) {
            return (float) $row->{$this->key};
        }

        return (float) 0;
    }
}
