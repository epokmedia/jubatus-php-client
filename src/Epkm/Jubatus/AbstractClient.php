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


    /**
     * @param mixed $rawData
     *
     * @return array
     */
    protected function encodeTypes($rawData)
    {
        if ($rawData instanceof TypeInterface) {
            return $this->encodeTypes($rawData->toArray());
        }

        if (is_array($rawData)) {
            $data = array();
            foreach ($rawData as $d) {
                $data[] = $this->encodeTypes($d);
            }
            return $data;
        }

        return $rawData;
    }

/*
    protected function decodeToObject($ret_array, $type_array) {
        if ($type_array == "") {
            // do nothing
            $ret = $ret_array;
        } else if (in_array($type_array, self::$USER_DEFINED_CLASSES)) {
            // array -> object
            $ret = new $type_array();
            $ret_keys = array_keys((array)$ret);
            for ($i = 0; $i < count($ret_keys); $i++) {
                $ret->{$ret_keys[$i]} = $ret_array[$i];
            }
        } else {
            // dissolve array
            if (is_array($type_array)) {
                if (count($type_array) == 1) {
                    // if array
                    foreach ($type_array as $key => $type) {
                        foreach ($ret_array as $ret_key => $ret_value) {
                            $ret[$ret_key] = self::decodeToObject($ret_value, $type);
                        }
                    }
                } else {
                    // if tuple
                    $ret = array();
                    $i = 0;
                    foreach ($type_array as $type) {
                        $ret[$i] = self::decodeToObject($ret_array[$i], $type);
                        $i++;
                    }
                }
            } else {
                // type error
                return $ret_array;
            }
        }
        return $ret;
    }
}
*/
}

