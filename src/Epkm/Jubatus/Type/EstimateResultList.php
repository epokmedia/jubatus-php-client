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
 * Class EstimateResultList
 *
 * @package Epkm\Jubatus\Type
 */
class EstimateResultList extends AbstractList {

    /**
     *
     */
    public function getBestMatch()
    {
        $maxScore = 0;
        $maxScoreItem = null;

        /** @var EstimateResult $estimateResult */
        foreach ($this->items as $estimateResult) {
            if ($estimateResult->getScore() > $maxScore) {
                $maxScore = $estimateResult->getScore();
                $maxScoreItem = $estimateResult;
            }
        }

        return $maxScoreItem;
    }

    /**
     * @param mixed $d
     *
     * @return TypeInterface
     */
    protected function createItem($d)
    {
        $item = new EstimateResult();
        $item->fromArray($d);

        return $item;
    }
}