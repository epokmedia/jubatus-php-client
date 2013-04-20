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
 * Class SimilarResult
 *
 * @package Epkm\Jubatus\Type
 */
class SimilarResult extends AbstractList {

    /**
     * @param mixed $d
     *
     * @return TypeInterface
     */
    protected function createItem($d)
    {
        $tuple = new StringFloatTuple();
        $tuple->fromArray($d);

        return $tuple;
    }
}