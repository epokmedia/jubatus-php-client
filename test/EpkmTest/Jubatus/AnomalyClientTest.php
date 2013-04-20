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

namespace EpkmTest\Jubatus;

use Epkm\Jubatus\Anomaly\Client;
use Epkm\Jubatus\Type\Datum;

/**
 * Class AnomalyClientTest
 */
class AnomalyClientTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Client;
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Client(\TestUtil::HOST, \TestUtil::PORT);
    }


    public function tearDown()
    {
        $this->client->clear();
        $this->client = null;
    }


    public function testClearRow()
    {
        $datum = new Datum();
        $datum->addNumValue('ok', 1.0);

        $result = $this->client->add($datum);
        $key = $result->getFirst();

        $this->assertTrue($this->client->clearRow($key));
        $this->assertEquals(0, count($this->client->getAllRows()));

    }


    public function testCalc()
    {
        $datum = new Datum();
        $datum->addNumValue('ok', 1.0);
        $datum->addNumValue('ok', 1.4);
        $datum->addNumValue('ok', 1.4);

        $anomaly = new Datum();
        $anomaly->addNumValue('nok', 1.3);
        $anomaly->addNumValue('nok', 2.3);
        $anomaly->addNumValue('nok', 2.3);

        $this->client->add($datum);

        $result = $this->client->calcScore($anomaly);

        $this->assertTrue($result > 0);
    }

}
