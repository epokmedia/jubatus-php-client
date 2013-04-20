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

namespace Epkm\Jubatus\Classifier;

use Epkm\Jubatus\AbstractClient;
use Epkm\Jubatus\Type\Datum;
use Epkm\Jubatus\Type\DatumList;
use Epkm\Jubatus\Type\DatumMultiMap;
use Epkm\Jubatus\Type\EstimateResultList;
use Epkm\Jubatus\Type\EstimateResultListList;
use Epkm\Jubatus\Type\StringDatumTuple;
use Epkm\Jubatus\Type\StringDatumTupleList;

/**
 * Class Client
 *
 * @package Epkm\Jubatus\Classifier
 */
class Client extends AbstractClient {

    /**
     * @param StringDatumTupleList $data
     * @param string               $taskName
     *
     * @return int
     */
    public function train(StringDatumTupleList $data, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('train', array($taskName, $data->toArray()));

        return (int) $result;
    }

    /**
     * @param string $label
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return int
     */
    public function trainDatum($label, Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $labelDatum = new StringDatumTuple($label, $datum);

        $labelDatumList = new StringDatumTupleList();
        $labelDatumList->add($labelDatum);

        return $this->train($labelDatumList, $taskName);
    }

    /**
     * Train a single string of text with the given label
     * @param string $label
     * @param string $string
     * @param string $taskName
     *
     * @return int
     */
    public function trainString($label, $string, $taskName = self::DEFAULT_TASK_NAME)
    {
        $datum = new Datum();
        $datum->addStringValue('message', $string);

        return $this->trainDatum($label, $datum, $taskName);
    }

    /**
     * @param DatumList $datumList
     * @param string    $taskName
     *
     * @return EstimateResultListList
     */
    public function classify(DatumList $datumList, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('classify', array($taskName, $datumList->toArray()));

        $estimateResultListList = new EstimateResultListList();
        $estimateResultListList->fromArray($result);

        return $estimateResultListList;
    }


    /**
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return mixed|null
     */
    public function classifyDatum(Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $datumList = new DatumList();
        $datumList->add($datum);

        $estimateResultListList = $this->classify($datumList, $taskName);

        return $estimateResultListList->getFirst();
    }

    /**
     * @param string $string
     * @param string $taskName
     *
     * @return null|EstimateResultList
     */
    public function classifyString($string, $taskName = self::DEFAULT_TASK_NAME)
    {
        $datum = new Datum();
        $datum->addStringValue('message', $string);

        return $this->classifyDatum($datum, $taskName);
    }
}