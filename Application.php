<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App;


use App\Library\User;


/**
 * A application class responsible to initialize the application
 *
 * @package App
 */
class Application
{
	/**
	 * This method retrieve retrieve the formatted list of customer and print the invitees which are with in 100KM
	 *
	 * @author Madhur Tandon
	 */
	public function Initialize()
	{
		$customerData = $this->GetDataFromFile();
		$users        = (new User())->GetFormattedList($customerData);
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @return array
	 */
	public function GetDataFromFile()
	{
		$file = './data' . DIRECTORY_SEPARATOR . 'customer.json';

		return json_decode(file_get_contents($file), JSON_OBJECT_AS_ARRAY);
	}
}