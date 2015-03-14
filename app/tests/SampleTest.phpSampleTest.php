<?php
//class SampleTest extends PHPUnit_Framework_TestCase

class SampleTest extends Illuminate\Foundation\Testing\TestCase {
{
    public function testSomething()
    {
        // Optional: Test anything here, if you want.
        $this->assertTrue(TRUE, 'This should already work.');

        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
?>
