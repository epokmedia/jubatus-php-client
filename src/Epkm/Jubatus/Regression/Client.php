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

namespace Epkm\Jubatus\Regression;


use Epkm\Jubatus\AbstractClient;
use Epkm\Jubatus\Type\Datum;
use Epkm\Jubatus\Type\DatumList;
use Epkm\Jubatus\Type\FloatDatumTuple;
use Epkm\Jubatus\Type\FloatDatumTupleList;

/**
 * Class Client
 *
 * @package Epkm\Jubatus\Regression
 */
class Client extends AbstractClient {


    /**
     * @param DatumList $datumList
     * @param string    $taskName
     *
     * @return array of float
     */
    public function estimate(DatumList $datumList, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('estimate', array($taskName, $datumList->toArray()));

        return $result;
    }

    /**
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return null\float
     */
    public function estimateDatum(Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $datumList = new DatumList();
        $datumList->add($datum);

        $result = $this->estimate($datumList, $taskName);
        $estimate = null;

        if (!empty($result)) {
            $estimate = reset($result);
        }

        return $estimate;
    }

    /**
     * @param FloatDatumTupleList $trainData
     * @param string              $taskName
     *
     * @return int
     */
    public function train(FloatDatumTupleList $trainData, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('train', array($taskName, $trainData->toArray()));

        return $result;
    }


    /**
     * @param float  $value
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return int
     */
    public function trainDatum($value, Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $list = new FloatDatumTupleList();
        $tuple = new FloatDatumTuple($value, $datum);

        $list->add($tuple);

        return $this->train($list, $taskName);
    }
}