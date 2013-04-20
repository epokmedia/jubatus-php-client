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

namespace Epkm\Jubatus\Recommender;


use Epkm\Jubatus\AbstractClient;
use Epkm\Jubatus\Type\Datum;
use Epkm\Jubatus\Type\SimilarResult;

/**
 * Class Client
 *
 * @package Epkm\Jubatus\Recommender
 */
class Client extends AbstractClient {

    /**
     * @param string $rowId
     * @param string $taskName
     *
     * @return bool
     */
    public function clearRow($rowId, $taskName = self::DEFAULT_TASK_NAME) {
        $result = $this->rpc->call('clear_row', array($taskName, $rowId));

        return $result;
    }

    /**
     * @param string $rowId
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return bool
     */
    public function updateRow($rowId, Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('update_row', array($taskName, $rowId, $datum->toArray()));

        return $result;
    }

    /**
     * @param Datum  $row
     * @param string $taskName
     *
     * @return float
     */
    public function calcL2norm(Datum $row, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('calc_l2norm', array($taskName, $row->toArray()));

        return $result;
    }

    /**
     * @param Datum  $lhs
     * @param Datum  $rhs
     * @param string $taskName
     *
     * @return float
     */
    public function calcSimilarity(Datum $lhs, Datum $rhs, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('calc_similarity', array($taskName, $lhs->toArray(), $rhs->toArray()));

        return $result;
    }

    /**
     * @param string $taskName
     *
     * @return array
     */
    public function getAllRows($taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('get_all_rows', array($taskName));

        return $result;
    }

    /**
     * @param string $rowId
     * @param string $taskName
     *
     * @return Datum
     */
    public function decodeRow($rowId, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('decode_row', array($taskName, $rowId));

        $datum = new Datum();
        $datum->fromArray($result);

        return $datum;
    }


    /**
     * @param Datum  $row
     * @param int    $size
     * @param string $taskName
     *
     * @return \Epkm\Jubatus\Type\SimilarResult
     */
    public function similarRowFromDatum(Datum $row, $size = 10, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('similar_row_from_datum', array($taskName, $row->toArray(), $size));

        $results = new SimilarResult();
        $results->fromArray($result);

        return $results;
    }

    /**
     * @param string $rowId
     * @param int    $size
     * @param string $taskName
     *
     * @return \Epkm\Jubatus\Type\SimilarResult
     */
    public function similarRowFromId($rowId, $size = 10, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('similar_row_from_id', array($taskName, $rowId, $size));

        $results = new SimilarResult();
        $results->fromArray($result);

        return $results;
    }

    /**
     * @param Datum  $row
     * @param string $taskName
     *
     * @return Datum
     */
    public function completeRowFromDatum(Datum $row, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('complete_row_from_datum', array($taskName, $row->toArray()));

        $datum = new Datum();
        $datum->fromArray($result);

        return $datum;
    }

    /**
     * @param string $rowId
     * @param string $taskName
     *
     * @return Datum
     */
    public function completeRowFromId($rowId, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('complete_row_from_id', array($taskName, $rowId));

        $datum = new Datum();
        $datum->fromArray($result);

        return $datum;
    }

}