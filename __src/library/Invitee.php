<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Library;


/**
 * This class will send the invitee to the users are with in the range of destination of 100KM from origin
 *
 * @package App\Library
 */
class Invitee
{
	/** @var array */
	protected $users;

	/** @var array */
	protected $destination;

	/** @var Int */
	protected $maxDistanceInKM;

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $users
	 * @param array $destination
	 * @param int   $maxDistanceInKM
	 *
	 * @throws Exception\InvalidArgument
	 */
	public function __construct(array $users, array $destination, int $maxDistanceInKM)
	{
		$this->SetUsers($users);

		$this->destination     = $destination;
		$this->maxDistanceInKM = $maxDistanceInKM;
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $users
	 *
	 * @return self
	 * @throws Exception\InvalidArgument
	 */
	protected function SetUsers(array $users)
	{
		if (empty($users)) {
			throw new Exception\InvalidArgument('User list can not be empty');
		}

		$this->users = $users;

		return $this;
	}

	/**
	 * This routine return the list of invitees that are with in the range of 100KM
	 *
	 * @author Madhur Tandon
	 *
	 * @return array
	 * @throws Exception\InvalidArgument
	 */
	public function GetInvitees()
	{
		$invitees = [];
		foreach ($this->users as $userID => $user) {
			$origin = [Distance::LATITUDE  => $user[User::LATITUDE],
					   Distance::LONGITUDE => $user[User::LONGITUDE]];

			$Distance     = new Distance($origin, $this->destination);
			$distanceInKM = $Distance->GetDistanceInKM();

			if ($this->IsInRange($distanceInKM)) {
				$invitees[$userID] = $user[User::NAME];
			}
		}

		// Sort in ascending order
		ksort($invitees);

		return $invitees;
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @param int $distanceInKM
	 *
	 * @return bool
	 */
	public function IsInRange($distanceInKM)
	{
		return $distanceInKM <= $this->maxDistanceInKM ? true : false;
	}
}