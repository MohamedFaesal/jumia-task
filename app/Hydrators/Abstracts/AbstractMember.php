<?php

namespace App\Hydrators\Abstracts;

use App\Hydrators\HydratorMembers\StringMember;

/**
 * AbstractMember Class is parent class for all Hydration members.
 * @author Mohamed Faesal <m.feasal@baims.com>
 */
abstract class AbstractMember
{
    /**
     * Hydrate wanted field from given row according to it's member's type
     * (i.e: name field into row was set as @see StringMember So hydrate will return hydrated field value as string).
     * @param object $row object contains data source details
     * @return mixed
     */
    abstract public function hydrate($row);
}
