<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Test;


use App\Library\Distance;
use App\Library\Test\TestCase;

/**
 * @package App\Test
 */
class DistanceTest extends TestCase
{
	const DESTINATION = [Distance::LATITUDE  => 53.3381985,
						 Distance::LONGITUDE => -6.2592576];

	/**
	 * @author Madhur Tandon
	 * @expectedException \App\Library\Exception\InvalidArgument
	 */
	public function testGetDistanceWithWrongDataFormat()
	{
		(new Distance([], []))->GetDistanceInKM();
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @return array
	 */
	public function DataProviderForEquality()
	{
		return [
			[54.374208, -8.371639, 180.0],
			[52.986375, -6.043701, 42],
			[52.966, -6.463, 44],
			[52.833502, -8.522366, 161],
			[54.0894797, -6.18671, 84.0]
		];
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @dataProvider DataProviderForEquality
	 *
	 * @param float $latitude
	 * @param float $longitude
	 * @param float $expectedDistanceINKM
	 */
	public function testEqualityAsTrueForDistanceInKM($latitude, $longitude, $expectedDistanceINKM)
	{
		$destination = [Distance::LATITUDE  => 53.3381985,
						Distance::LONGITUDE => -6.2592576];

		$origin = [Distance::LATITUDE  => $latitude,
				   Distance::LONGITUDE => $longitude];

		$distanceInKM = (new Distance($origin, $destination))->GetDistanceInKM();

		$this->assertEquals($expectedDistanceINKM, $distanceInKM);
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @return array
	 */
	public function DataProviderForEqualityAsFalse()
	{
		return [
			[54.374208, -8.371639, 180.1],
			[52.986375, -6.043701, 42.1],
			[52.966, -6.463, 44.9],
			[52.833502, -8.522366, 163],
			[54.0894797, -6.18671, 84.4]
		];
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @dataProvider DataProviderForEqualityAsFalse
	 *
	 * @param float $latitude
	 * @param float $longitude
	 * @param float $expectedDistanceINKM
	 */
	public function testEqualityAsFalseForDistanceInKM($latitude, $longitude, $expectedDistanceINKM)
	{
		$destination = [Distance::LATITUDE  => 53.3381985,
						Distance::LONGITUDE => -6.2592576];

		$origin = [Distance::LATITUDE  => $latitude,
				   Distance::LONGITUDE => $longitude];

		$distanceInKM = (new Distance($origin, $destination))->GetDistanceInKM();

		$this->assertNotEquals($expectedDistanceINKM, $distanceInKM);
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @return array
	 */
	public function DataProviderWithInRange100KM()
	{
		return [
			[53.2451022, -6.238335],
			[52.986375, -6.043701],
			[53.74452, -7.11167]
		];
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @dataProvider DataProviderWithInRange100KM
	 *
	 * @param float $latitude
	 * @param float $longitude
	 */
	public function testDistanceWithInRangeOf100KM($latitude, $longitude)
	{
		$destination = [Distance::LATITUDE  => 53.3381985,
						Distance::LONGITUDE => -6.2592576];

		$origin = [Distance::LATITUDE  => $latitude,
				   Distance::LONGITUDE => $longitude];

		$distanceInKM = (new Distance($origin, $destination))->GetDistanceInKM();

		$this->assertTrue($distanceInKM <= 100);
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @return array
	 */
	public function DataProviderMoreThan100KM()
	{
		return [
			[51.999447, -9.742744],
			[54.374208, -8.371639]
		];
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @dataProvider DataProviderMoreThan100KM
	 *
	 * @param float $latitude
	 * @param float $longitude
	 */
	public function testDistanceMoreThan100KM($latitude, $longitude)
	{
		$destination = [Distance::LATITUDE  => 53.3381985,
						Distance::LONGITUDE => -6.2592576];

		$origin = [Distance::LATITUDE  => $latitude,
				   Distance::LONGITUDE => $longitude];

		$distanceInKM = (new Distance($origin, $destination))->GetDistanceInKM();

		$this->assertTrue($distanceInKM > 100);
	}
}
