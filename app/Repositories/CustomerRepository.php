<?php

namespace App\Repositories;

use App\Hydrators\CustomerHydrator;
use App\Models\Customer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CustomerRepository
{
    public function findBy(array $criteria = []) : array {
        $customers = Customer::all();
        $customerHydrator = new CustomerHydrator();
        $filtered = [];
        foreach ($customers as $customer) {
            $customer = $customerHydrator->hydrate($customer);
            if (isset($criteria['status'])) {
                $value = $criteria['status'] == 'valid';
                if ($customer->isValid != $value) {
                    continue;
                }
            }

            if (isset($criteria['country_code'])) {
                if ($criteria['country_code'] != $customer->phoneCode) {
                    continue;
                }
            }
            $filtered[] = $customer;
        }
        return $filtered;
    }
}