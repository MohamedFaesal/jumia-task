<?php

declare(strict_types=1);

namespace App\Hydrators;

use App\Entities\Customer;
use App\Hydrators\Abstracts\AbstractHydrator;
use App\Hydrators\HydratorMembers\IntegerMember;
use App\Hydrators\HydratorMembers\StringMember;
use App\Utilities\PhoneUtil;

class CustomerHydrator extends AbstractHydrator
{
    /**
     * {@inheritdoc}
     */
    protected function getDefaultEntityMap(): array
    {
        return [
            'id' => new IntegerMember('id'),
            'name' => new StringMember('name'),
            'phone' => new StringMember('phone')
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultEntity(): Customer
    {
        return new Customer();
    }

    public function hydrate(object $data, array $map = [])
    {
        $customer = parent::hydrate($data, $map);
        $customer->phoneCode = substr($customer->phone, 1,3);
        $customer->phoneNumber = substr($customer->phone, 6);
        $customer->country = PhoneUtil::getCountryByCode($customer->phoneCode);
        $regex = PhoneUtil::getRegexForCode($customer->phoneCode);
        $customer->isValid = (bool) preg_match($regex, $customer->phoneNumber);   ;
        return $customer;
    }
}
