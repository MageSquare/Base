<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Exceptions;

class StopValidation extends \Exception
{
    /**
     * @var array|bool
     */
    protected $validateResult;

    /**
     * @param array|bool $validateResult
     */
    public function __construct($validateResult)
    {
        $this->validateResult = $validateResult;
    }

    /**
     * @return array|bool
     */
    public function getValidateResult()
    {
        return $this->validateResult;
    }
}
