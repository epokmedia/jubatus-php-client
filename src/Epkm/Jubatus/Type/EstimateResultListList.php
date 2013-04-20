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
 * Class EstimateResultListList
 *
 * @package Epkm\Jubatus\Type
 */
class EstimateResultListList extends AbstractList {

    /**
     * @param mixed $d
     *
     * @return TypeInterface
     */
    protected function createItem($d)
    {
        $item = new EstimateResultList();
        $item->fromArray($d);

        return $item;
    }
}