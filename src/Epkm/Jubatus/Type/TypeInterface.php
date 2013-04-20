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
 * Class TypeInterface
 *
 * @package Epkm\Jubatus\Type
 */
interface TypeInterface {

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param array $data
     *
     * @return void
     */
    public function fromArray(array $data);
}