<?php

namespace App\Hydrators\HydratorMembers;

use App\Hydrators\Abstracts\AbstractMember;

class StringMember extends AbstractMember
{
    /**
     * @var string specified to get the element from the data source array
     */
    private $key;

    /**
     * StringMember constructor.
     * @param string $key field name wanted to cast
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function hydrate($row)
    {
        if (isset($row->{$this->key})) {
            return (string) $row->{$this->key};
        }

        return '';
    }
}
