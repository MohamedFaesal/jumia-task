<?php

namespace App\Hydrators\HydratorMembers;

use App\Hydrators\Abstracts\AbstractMember;

class ConstantMember extends AbstractMember
{
    /**
     * @var string specified to get the element from the data source array
     */
    public $key;

    /**
     * @var array to map value from data source to another value
     *
     *  $dataSource = [
     *      'report_type' => 'FBR'
     *  ];
     *  $valueMap = [
     *      'FBR' => 'Facebook Report'
     *  ];
     */
    public $valueMap;

    /**
     * ConstantMember constructor.
     * @param string $key      field name wanted to cast
     * @param array  $valueMap map values for given field's value
     */
    public function __construct(string $key, array $valueMap)
    {
        $this->key = $key;
        $this->valueMap = $valueMap;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function hydrate($row)
    {
        if (isset($row->{$this->key})) {
            if (array_key_exists($row->{$this->key}, $this->valueMap)) {
                return $this->valueMap[$row->{$this->key}];
            }
        }

        return '';
    }
}
