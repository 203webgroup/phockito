<?php

require_once(dirname(dirname(__FILE__)) . '/Phockito.php');

class PhockitoOverloadedCallTest_OverloadedCall {
	function __call($name, $args) { return $name; }
    function Foo() { throw new Exception('Base method Foo was called'); }
}

class PhockitoOverloadedCallTest extends PHPUnit_Framework_TestCase {

	function testMockingCall() {
		$mock = Phockito::mock('PhockitoOverloadedCallTest_OverloadedCall');

		Phockito::when($mock)->Foo()->return(1);
		$this->assertEquals($mock->Foo(), 1);
        $mock->Foo();

		Phockito::verify($mock, 2)->Foo();
	}

	function testSpyingCall() {
		$spy = Phockito::spy('PhockitoOverloadedCallTest_OverloadedCall');

		Phockito::when($spy)->Foo()->return(1);
		$this->assertEquals($spy->Foo(), 1);
        $spy->Foo();

		Phockito::verify($spy, 2)->Foo();
	}
}
