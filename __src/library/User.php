<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Library;


/**
 * This library is used to provide the structured format of the user listing
 *
 * @package App\Library
 */
class User
{
	const USER_ID   = 'user_id';
	const NAME      = 'name';
	const LATITUDE  = 'latitude';
	const LONGITUDE = 'longitude';

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $data
	 *
	 * @return array
	 * @throws InvalidArgument
	 * @throws InvalidData
	 */
	public function GetUsers(array $data)
	{
		if (empty($data)) {
			throw new InvalidArgument('Empty data provided');
		}

		$list = [];
		foreach ($data as $record) {
			$this->ValidateUser($record);

			$list[$record[self::USER_ID]] = [self::NAME      => $record[self::NAME],
											 self::LATITUDE  => $record[self::LATITUDE],
											 self::LONGITUDE => $record[self::LONGITUDE]];
		}

		return $list;
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $record
	 *
	 * @throws InvalidData
	 */
	public function ValidateUser(array $record)
	{
		if (!isset($record[self::USER_ID])) {
			throw new InvalidData('User ID is missing');
		} else if (!isset($record[self::NAME])) {
			throw new InvalidData('User Name is missing');
		} else if (!isset($record[self::LATITUDE])) {
			throw new InvalidData('User Latitude is missing');
		} else if (!isset($record[self::LONGITUDE])) {
			throw new InvalidData('User Longitude is missing');
		}
	}
}