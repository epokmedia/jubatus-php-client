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


use Epkm\Jubatus\Regression\Client;
use Epkm\Jubatus\Type\Datum;
use PHPUnit_Framework_TestCase;

/**
 * Class RegressionClientTest
 * @package EpkmTest\Jubatus
 */
class RegressionClientTest extends PHPUnit_Framework_TestCase {

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

    public function testTrainAndEstimate()
    {

        $datum = new Datum();
        $datum->addNumValue('value', 1.0);


        $datum2 = new Datum();
        $datum2->addNumValue('value', 2.0);


        $datum3 = new Datum();
        $datum3->addNumValue('value', 3.0);

        $this->client->trainDatum(20.0, $datum);
        $this->client->trainDatum(40.0, $datum2);
        $this->client->trainDatum(60.0, $datum3);

        $toEstimate = new Datum();
        $toEstimate->addNumValue('value', 4.0);

        $result = $this->client->estimateDatum($toEstimate);

        $this->assertTrue($result > 0);
    }


}
