<?php

namespace App\Hydrators\HydratorMembers;

use App\Hydrators\Abstracts\AbstractMember;

class DirectValueMember extends AbstractMember
{
    /**
     * DirectValueMember constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function hydrate($row)
    {
        return $this->value;
    }
}
