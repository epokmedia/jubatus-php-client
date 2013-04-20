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

namespace Epkm\Jubatus;

use Epkm\Jubatus\Type\TypeInterface;
use Epkm\MessagePackRpc\Client as MessagePackRpcClient;
use Zend\Json\Json;

/**
 * Class AbstractClient
 *
 * @package Epkm\Jubatus
 */
abstract class AbstractClient {

    /**
     * Default Zookeeper task name
     */
    const DEFAULT_TASK_NAME = '';

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var MessagePackRpcClient
     */
    protected $rpc;

    /**
     * @param $host
     * @param $port
     * @param $timeout
     */
    public function __construct($host, $port, $timeout = 60)
    {
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;

        $this->rpc = new MessagePackRpcClient($host, $port);
    }

    /**
     * @param string $taskName
     *
     * @return array
     */
    public function getConfig($taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('get_config', array($taskName));

        $config = Json::decode($result, Json::TYPE_ARRAY);

        return $config;
    }

    /**
     * @param string $taskName
     *
     * @return array
     */
    public function getStatus($taskName = self::DEFAULT_TASK_NAME)
    {
        $result = $this->rpc->call('get_status', array($taskName));

        return $result;
    }

    /**
     * @param string $taskName
     *
     * @return bool
     */
    public function clear($taskName = self::DEFAULT_TASK_NAME)
    {
        return $this->rpc->call('clear', array($taskName));
    }

    /**
     * @param string $id
     * @param string $taskName
     *
     * @return bool
     */
    public function load($id, $taskName = self::DEFAULT_TASK_NAME)
    {
        return $this->rpc->call('load', array($taskName, $id));
    }

    /**
     * @param string $id
     * @param string $taskName
     *
     * @return bool
     */
    public function save($id, $taskName = self::DEFAULT_TASK_NAME)
    {
        return $this->rpc->call('save', array($taskName, $id));
    }


}

