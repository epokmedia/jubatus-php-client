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

namespace Epkm\Jubatus\Anomaly;


use Epkm\Jubatus\AbstractClient;
use Epkm\Jubatus\Type\Datum;
use Epkm\Jubatus\Type\StringFloatTuple;

/**
 * Class Client
 *
 * @package Epkm\Jubatus\Anomaly
 */
class Client extends AbstractClient {


    /**
     * @param string $rowId
     * @param string $taskName
     *
     * @return bool
     */
    public function clearRow($rowId, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('clear_row', array($taskName, $rowId));

        return $result;
    }


    /**
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return StringFloatTuple
     */
    public function add(Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('add', array($taskName, $datum->toArray()));

        $tuple = new StringFloatTuple();
        $tuple->fromArray($result);

        return $tuple;
    }


    /**
     * @param string $rowId
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return float
     */
    public function update($rowId, Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('update', array($taskName, $rowId, $datum->toArray()));

        return $result;
    }

    /**
     * @param Datum  $datum
     * @param string $taskName
     *
     * @return float
     */
    public function calcScore(Datum $datum, $taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('calc_score', array($taskName, $datum->toArray()));

        return $result;
    }

    /**
     * @param string $taskName
     *
     * @return string[]
     */
    public function getAllRows($taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('get_all_rows', array($taskName));

        return $result;
    }
}