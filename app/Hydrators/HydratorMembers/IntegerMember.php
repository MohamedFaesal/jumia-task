<?php

namespace App\Hydrators\HydratorMembers;

use App\Hydrators\Abstracts\AbstractMember;

class IntegerMember extends AbstractMember
{
    /**
     * @var string specified to get the element from the data source array
     */
    private $key;

    /**
     * IntegerMember constructor.
     * @param string $key field name wanted to cast
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     * @return int
     */
    public function hydrate($row)
    {
        if (isset($row->{$this->key})) {
            return (int) $row->{$this->key};
        }

        return 0;
    }
}
