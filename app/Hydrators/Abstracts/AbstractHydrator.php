<?php

namespace App\Hydrators\Abstracts;

use App\Entities\Entity;
use Illuminate\Support\Arr;

abstract class AbstractHydrator
{
    /**
     * The map that will be used to map the columns into Database to entities properties.
     * <br/> Here is inline Example:
     * <code>
     * To cast a value from data source to string value use @see StringMember class.
     * <br /> // companyName is Entity property
     * // company_name is column name from data source
     * <?php
     *     $this->map = [
     *          'companyName' => new StringMember('company_name')
     *     ];
     * ?>
     * </code>
     * <br /> To map object from data source to entity use @see ObjectMember class.
     * // creator is instance from Creator object
     * // user is the key in data source which is object
     * // $userHydrator instance from UserHydrator Class to create instance from user entity
     * // $map is associative array which the user entity properties are keys and value is columns
     * names from data source
     * <code>
     *     $this->map = [
     *          'creator' => new ObjectMember('user', $userHydrator, $map)
     *     ];
     * </code>
     * <br /> To map array of objects from data source to array of objects use @see ArrayOfObjectsMember class.
     * // companiesCollection is array
     * // companies is the key in data source which is array of objects
     * // $companyHydrator instance from CompanyHydrator Class to create instance from company entity
     * // $map is associative array which the company entity properties are keys and value is columns
     * names from data source
     * <code>
     *     $this->map = [
     *          'companiesCollection' => new ArrayOfObjectsMember('companies', $companyHydrator, $map)
     *     ];
     * </code>
     *  <br /> To map array from data source to array use @see ArrayMember class.
     * // categories is array
     * // categories is the key in data source which is array
     * <code>
     *     $this->map = [
     *          'categories' => new ArrayMember('categories')
     *     ];
     * </code>
     * <br /> To map value from data source to another value use @see ConstantMember class.
     * // reportType is entity property
     * // report_type is the key in data source which its value need to be mapped
     * // $valueMap associative array with keys the value of report_type and value is the actual value
     * <code>
     *     $this->map = [
     *          'reportType' => new ConstantMember('report_type', $valueMap)
     *     ];
     * </code>.
     * @var array
     */
    protected $map;

    protected array $only = [];

    /**
     * AbstractHydrator constructor.
     */
    final public function __construct()
    {
    }

    /**
     * Getting the Entity map for fill data row into their related Entity's properties.
     * @return array
     */
    abstract protected function getDefaultEntityMap() : array;

    /**
     * Getting the entity associated with the hydrated object.
     * @return mixed
     */
    abstract protected function getDefaultEntity();

    /**
     * filtering default mapping keys.
     *
     * @param array $attributes
     * @return $this
     */
    public function only(array $attributes): self
    {
        $this->only = $attributes;

        return $this;
    }

    /**
     * Hydrator data row/rows value into given Entity object to complete operation of convert.
     * @param object $data object model or array of models
     * @param array $map given new entity map wanted to use instead of the default entity map
     *                   using @return array|Entity
     * @return array|Entity
     * @throws HydrationFailure if hydration operation failed
     * @see AbstractHydrator::getDefaultEntityMap
     */
    public function hydrate(object $data, array $map = [])
    {
        if (is_iterable($data)) {
            $entities = [];
            foreach ($data as $row) {
                $entities[] = $this->hydrate($row, $map);
            }

            return $entities;
        }

        // get Entity mapping according to given map or use default entity map
        if (empty($map)) {
            $this->map = count($this->only) ? Arr::only($this->getDefaultEntityMap(), $this->only) : $this->getDefaultEntityMap();
        } else {
            $this->map = $map;
        }
        // get Entity mapping according to given map or use default entity map
        // and filter them according to the columns that provided by $this->only
        $map = empty($map) ? $this->getDefaultEntityMap() : $map;
        $this->map = count($this->only) ? Arr::only($map, $this->only) : $map;

        $entity = $this->getDefaultEntity();

        try {
            foreach ($this->map as $entityMember => $hydratorMember) {
                $entity->{$entityMember} = $hydratorMember->hydrate($data);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $entity;
    }
}
