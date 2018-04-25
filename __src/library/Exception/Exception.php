<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */


namespace App\Library;


/**
 * @package App\Library
 */
class Exception extends \Exception
{
	/**
	 * @author Madhur Tandon
	 *
	 * @param string     $errorMessage (OPTIONAL)
	 * @param int        $errorCode    (OPTIONAL)
	 * @param \Exception $previous     (OPTIONAL)
	 */
	public function __construct($errorMessage = '', $errorCode = 0, \Exception $previous = null)
	{
		parent::__construct($errorMessage, $errorCode, $previous);
	}
}
