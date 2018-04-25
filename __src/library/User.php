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
	 */
	public function GetFormattedList(array $data)
	{
		$list = [];
		foreach ($data as $record) {
			$list[$record[self::USER_ID]] = [self::NAME      => $record[self::NAME],
											 self::LATITUDE  => $record[self::LATITUDE],
											 self::LONGITUDE => $record[self::LONGITUDE]];
		}

		return $list;
	}
}