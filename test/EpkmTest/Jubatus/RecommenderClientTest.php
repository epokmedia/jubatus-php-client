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

use Epkm\Jubatus\Recommender\Client;
use Epkm\Jubatus\Type\Datum;
use Epkm\Jubatus\Type\SimilarResult;

/**
 * Class RecommenderClientTest
 *
 * @package EpkmTest\Jubatus
 */
class RecommenderClientTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Client
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


    public function testUpdateRow()
    {
        $datum = new Datum();
        $datum->addStringValue('hey', 'ok');

        $result = $this->client->updateRow('row', $datum);

        $this->assertTrue($result);
    }

    public function testCalcSimilarity()
    {
        $datum = new Datum();
        $datum->addStringValue('product/name', 'Macbook Air');
        $datum->addStringValue('product/vendor', 'Apple');

        $datum2 = new Datum();
        $datum2->addStringValue('product/name', 'Macbook Pro');
        $datum2->addStringValue('product/vendor', 'Apple');

        $result = $this->client->calcSimilarity($datum, $datum2);

        $this->assertTrue(is_float($result));
        $this->assertTrue($result > 0);
    }


    public function testSimilarRowFromDatum()
    {
        $datum = new Datum();
        $datum->addStringValue('product/name', 'Macbook Air');
        $datum->addStringValue('product/vendor', 'Apple');

        $datum2 = new Datum();
        $datum2->addStringValue('product/name', 'Macbook Pro');
        $datum2->addStringValue('product/vendor', 'Apple');

        $compare = new Datum();
        $compare->addStringValue('product/name', 'Macbook Pro Retina');
        $compare->addStringValue('product/vendor', 'Apple');

        $this->client->updateRow('1', $datum);
        $this->client->updateRow('2', $datum2);
        $result = $this->client->similarRowFromDatum($compare);

        $this->assertTrue($result instanceof SimilarResult);
        $this->assertTrue($result->count() === 2);

        $result = $this->client->similarRowFromDatum($compare,1);
        $this->assertTrue($result->count() === 1);
    }

    public function testCompleteRowFromDatum()
    {
        $datum = new Datum();
        $datum->addStringValue('product/name', 'Macbook Air');
        $datum->addStringValue('product/vendor', 'Apple');

        $datum2 = new Datum();
        $datum2->addStringValue('product/name', 'Macbook Pro');
        $datum2->addStringValue('product/vendor', 'Apple');

        $compare = new Datum();
        $compare->addStringValue('product/vendor', 'Apple');

        $this->client->updateRow('1', $datum);
        $this->client->updateRow('2', $datum2);
        $result = $this->client->completeRowFromDatum($compare);

        $this->assertTrue($result instanceof Datum);
        $this->assertTrue(count($result->getStringValues()) === 3);
    }


}
