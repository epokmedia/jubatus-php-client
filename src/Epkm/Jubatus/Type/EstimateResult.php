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

namespace Epkm\Jubatus\Type;

/**
 * Class EstimateResult
 *
 * @package Epkm\Jubatus\Type
 */
class EstimateResult implements TypeInterface {

    /**
     * @var string
     */
    protected $label;

    /**
     * @var float
     */
    protected $score;

    /**
     * @param string $label
     * @param float  $score
     */
    public function __construct($label = null, $score = null)
    {
        $this->label = $label;
        $this->score = $score;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }




    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            $label,
            $score
        );
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function fromArray(array $data)
    {
        list($label, $score) = $data;

        $this->label = $label;
        $this->score = $score;
    }
}