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
 * Class Datum
 *
 * @package Epkm\Jubatus\Type
 */
class Datum implements TypeInterface {

    /**
     * @var array
     */
    protected $stringValues = array();

    /**
     * @var array
     */
    protected $numValues = array();

    /**
     * @param array $numValues
     * @param array $stringValues
     */
    public function __construct(array $numValues = array(), array $stringValues = array())
    {
        $this->numValues = $numValues;
        $this->stringValues = $stringValues;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addStringValue($key, $value)
    {
        $this->stringValues[] = array($key, (string) $value);
    }


    /**
     * @param string $key
     * @param float  $value
     */
    public function addNumValue($key, $value)
    {
        $this->numValues[] = array($key, (float) $value);
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $data = array(
            $this->stringValues === null ? array() : $this->stringValues
        );

        if ($this->numValues !== null && count($this->numValues) > 0) {
            $data[] = $this->numValues;
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function fromArray(array $data)
    {
        list($stringValue, $numValues) = $data;

        $this->stringValues = is_array($stringValue) ? $stringValue : array();
        $this->numValues = is_array($numValues) ? $numValues : array();

    }
}