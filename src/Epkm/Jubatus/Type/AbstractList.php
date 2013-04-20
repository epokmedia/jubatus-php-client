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

use ArrayIterator;
use IteratorAggregate;

/**
 * Class AbstractList
 *
 * @package Epkm\Jubatus\Type
 */
abstract class AbstractList implements TypeInterface, IteratorAggregate, \Countable {

    /**
     * @var array;
     */
    protected $items = array();


    /**
     * @param mixed $data
     *
     * @return $this
     */
    public function add($data) {
        $this->items[] = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = array();
        foreach ($this->items as $d) {
            $data[] = $d instanceof TypeInterface ? $d->toArray() : $d;
        }

        return $data;
    }

    /**
     * @return mixed|null
     */
    public function getFirst()
    {
        if (count($this->items) > 0) {
            return reset($this->items);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function fromArray(array $data)
    {
        foreach ($data as $d) {
            $item = $this->createItem($d);
            $this->add($item);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     *       The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->items);
    }


    /**
     * @param mixed $d
     *
     * @return TypeInterface
     */
    abstract protected function createItem($d);


}