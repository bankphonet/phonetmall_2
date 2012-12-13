<?php



require_once __DIR__ . '/../init.php';




class advertisementTest extends PHPUnit_Framework_TestCase
{
	private $ad;
	
	function __construct()
	{
		$this->ad = new advertisement(new Cdb());	
	}
	
	/**
	 * test get_ads
	 */
	
	function testadsTest ()
	{
		$this->assertEmpty($this->ad->get_ads(array('ads.id'=>'5000')));
	}
	
	function testTrue()
	{
		$this->assertTrue(true);
	}
	
	
}

?>