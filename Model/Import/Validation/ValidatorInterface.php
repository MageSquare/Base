<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Model\Import\Validation;

/**
 * @since 1.4.6
 */
interface ValidatorInterface
{
    /**
     * Return array with error codes. Return true on validation pass
     *
     * @param array  $rowData
     * @param string $behavior
     *
     * @throws \MageSquare\Base\Exceptions\StopValidation
     * @return array|bool
     */
    public function validateRow(array $rowData, $behavior);

    /**
     * Return array: error_code => error_message
     *
     * @return array
     */
    public function getErrorMessages();

    /**
     * @param string $message
     * @param int $level
     *
     * @return ValidatorInterface
     */
    public function addRuntimeError($message, $level);
}
