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


use Epkm\Jubatus\Classifier;
use Epkm\Jubatus\Type\Datum;
use Epkm\Jubatus\Type\DatumMultiMap;
use Epkm\Jubatus\Type\EstimateResult;
use Epkm\Jubatus\Type\EstimateResultList;
use Epkm\Jubatus\Type\StringDatumTuple;
use Epkm\Jubatus\Type\StringDatumTupleList;
use PHPUnit_Framework_TestCase;


/**
 * Class ClassifierClientTest
 *
 * @package EpkmTest\Jubatus
 */
class ClassifierClientTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Classifier\Client;
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Classifier\Client(\TestUtil::HOST, \TestUtil::PORT);
    }


    public function tearDown()
    {
        $this->client = null;
    }


    public function testGetConfig()
    {
        $config = $this->client->getConfig();

        $this->assertTrue(isset($config['method']));
        $this->assertTrue(isset($config['converter']));

    }

    public function testGetStatus()
    {
        $statuses = $this->client->getStatus();

        $this->assertTrue(is_array($statuses));

        foreach ($statuses as $status) {
            $this->assertTrue(isset($status['PROGNAME']));
        }

    }

    public function testClear()
    {
        $result = $this->client->clear();

        $this->assertTrue($result);
    }


    public function testTrain()
    {
        $datum = new Datum();
        $datum->addStringValue('message', 'ok');

        $labelDatum = new StringDatumTuple('label', $datum);
        $labelDatum2 = new StringDatumTuple('label2', $datum);

        $labelDatumList = new StringDatumTupleList();
        $labelDatumList->add($labelDatum)
                       ->add($labelDatum2);

        $result = $this->client->train($labelDatumList);

        $this->assertEquals(2, $result);
    }

    public function testTrainString()
    {
        $result = $this->client->trainString('label', 'string');

        $this->assertEquals(1, $result);
    }

    public function testClassifyString()
    {
        $this->client->trainString('ham', 'hello this is dog');
        $this->client->trainString('ham', 'not a single fuck was given when the dog died');
        $this->client->trainString('ham', 'i had a lot of karma after i posted my dog on awww');
        $this->client->trainString('spam', 'free watches in limited stock');
        $this->client->trainString('spam', 'special offer on luxury watches');

        $result = $this->client->classifyString('i just bought some food for your dog');


        $this->assertTrue($result instanceof EstimateResultList);

        /** @var EstimateResult $estimateResult */
        $estimateResult = $result->getFirst();

        $this->assertTrue($estimateResult instanceof EstimateResult);
        $this->assertEquals('ham', $estimateResult->getLabel());
        $this->assertTrue($estimateResult->getScore() > 0);


        $result = $this->client->classifyString('free luxury watches for your dog');

        $this->assertTrue($result instanceof EstimateResultList);

        foreach ($result as $estimateResult) {
            $this->assertTrue($estimateResult instanceof EstimateResult);
        }

        $bestMatch = $result->getBestMatch();

        $this->assertEquals('spam', $bestMatch->getLabel());
        $this->assertTrue($bestMatch->getScore() > 0);
    }

}
