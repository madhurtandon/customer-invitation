<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Library;


/**
 * This class will we used to calculate the distance between the origin and destination
 *
 * @package App\Library
 */
class Distance
{
	const LATITUDE  = 'latitude';
	const LONGITUDE = 'longitude';

	// Radius for spherical Earth, mean earth radius
	const EARTH_RADIUS = '6371.009';

	/** @var float */
	protected $originLatitude;

	/** @var float */
	protected $originLongitude;

	/** @var float */
	protected $destinationLatitude;

	/** @var float */
	protected $destinationLongitude;

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $origin
	 * @param array $destination
	 *
	 * @throws InvalidArgument
	 */
	public function __construct(array $origin, array $destination)
	{
		$this->SetOrigin($origin)
			 ->SetDestination($destination);
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $origin
	 *
	 * @return self
	 * @throws InvalidArgument
	 */
	protected function SetOrigin(array $origin)
	{
		if (!isset($origin[self::LATITUDE]) || !isset($origin[self::LONGITUDE])) {
			throw new InvalidArgument('Origin is missing with the latitude and longitude');
		}

		$this->originLatitude  = $origin[self::LATITUDE];
		$this->originLongitude = $origin[self::LONGITUDE];

		return $this;
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @param array $destination
	 *
	 * @return self
	 * @throws InvalidArgument
	 */
	protected function SetDestination(array $destination)
	{
		if (!isset($destination[self::LATITUDE]) || !isset($destination[self::LONGITUDE])) {
			throw new InvalidArgument('Destination is missing with the latitude and longitude');
		}

		$this->destinationLatitude  = $destination[self::LATITUDE];
		$this->destinationLongitude = $destination[self::LONGITUDE];

		return $this;
	}

	/**
	 * This routine produces distance in KM along the great circle line
	 *
	 * @author Madhur Tandon
	 *
	 * @return int
	 */
	public function GetDistanceInKM()
	{
		$originLatitude       = deg2rad($this->originLatitude);
		$originLongitude      = deg2rad($this->originLongitude);
		$destinationLatitude  = deg2rad($this->destinationLatitude);
		$destinationLongitude = deg2rad($this->destinationLongitude);

		$latitudeDelta  = $destinationLatitude - $originLatitude;
		$longitudeDelta = $destinationLongitude - $originLongitude;

		$angle = 2 * asin(sqrt(pow(sin($latitudeDelta / 2), 2) +
							   cos($originLatitude) * cos($destinationLatitude) * pow(sin($longitudeDelta / 2), 2)));

		return round($angle * self::EARTH_RADIUS);
	}
}