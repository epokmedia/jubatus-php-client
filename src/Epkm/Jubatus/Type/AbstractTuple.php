<?php
/**
 *
 * LICENCE
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 *
 * @author Schwartz Michaël
 * @copyright Copyright (c) EPOKMEDIA SARL
 *
 */

namespace Epkm\Jubatus\Type;

/**
 * Class AbstractTuple
 *
 * @package Epkm\Jubatus\Type
 */
class AbstractTuple implements TypeInterface {

    /**
     * @var mixed
     */
    protected $first;

    /**
     * @var mixed
     */
    protected $second;

    /**
     * @param $first
     * @param $second
     */
    public function __construct($first = null, $second = null) {
        $this->first = $first;
        $this->second = $second;
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @return mixed
     */
    public function getSecond()
    {
        return $this->second;
    }




    /**
     * @return array
     */
    public function toArray()
    {
        $first = $this->first instanceof TypeInterface ? $this->first->toArray() : $this->first;
        $second = $this->second instanceof TypeInterface ? $this->second->toArray() : $this->second;

        return array($first, $second);
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function fromArray(array $data)
    {
        list($first, $second) = $data;

        $this->first = $first;
        $this->second = $second;
    }

}