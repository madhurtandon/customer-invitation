<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App;


use App\Library\User;
use App\Library\Invitee;
use App\Library\Distance;
use App\Library\Parser\File;


/**
 * A application class responsible to initialize the application
 *
 * @package App
 */
class Application
{
	const MAX_DISTANCE_IN_KM = 100;

	/**
	 * This method retrieve retrieve the formatted list of customer and print the invitees which are with in 100KM
	 *
	 * @author Madhur Tandon
	 */
	public function Initialize()
	{
		$filePath = DIR_PREFIX . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'customer.txt';

		// Retrieve the data from the local file system
		$data = (new File($filePath))->GetData();

		// Get the user details in a structured format
		$users = (new User())->GetUsers($data);

		$destination = [Distance::LATITUDE  => '53.339428',
						Distance::LONGITUDE => '-6.257664'];

		// Get the invitees within the range of origin and destination
		$invitees = (new Invitee($users, $destination, self::MAX_DISTANCE_IN_KM))->GetInvitees();

		$this->PrintInvitees($invitees);
	}

	/**
	 * Print the list of invitees
	 *
	 * @param array $invitees
	 */
	public function PrintInvitees(array $invitees)
	{
		if (empty($invitees)) {
			echo 'No Invitee found with in the range of ' . self::MAX_DISTANCE_IN_KM . ' KM';
			exit;
		}

		foreach ($invitees as $inviteeID => $invitee) {
			echo 'User ' . $inviteeID . ' ' . $invitee . ' is with in the range of ' . self::MAX_DISTANCE_IN_KM . ' KM';
			echo "\n";
		}

		return;
	}

}