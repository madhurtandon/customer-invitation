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
	 * @throws Exception\InvalidArgument
	 * @throws Exception\InvalidData
	 */
	public function GetUsers(array $data)
	{
		if (empty($data)) {
			throw new Exception\InvalidArgument('Empty data provided');
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
	 * @throws Exception\InvalidData
	 */
	public function ValidateUser(array $record)
	{
		if (!isset($record[self::USER_ID])) {
			throw new Exception\InvalidData('User ID is missing');
		} else if (!isset($record[self::NAME])) {
			throw new Exception\InvalidData('User Name is missing');
		} else if (!isset($record[self::LATITUDE])) {
			throw new Exception\InvalidData('User Latitude is missing');
		} else if (!isset($record[self::LONGITUDE])) {
			throw new Exception\InvalidData('User Longitude is missing');
		}
	}
}