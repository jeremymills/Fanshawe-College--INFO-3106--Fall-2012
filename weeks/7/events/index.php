<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

class Subject {
	private $_listeners = array();
	
	public function __construct() {
	}
	
	public function attachListener(IListener &$listener) {
		if( false === array_search($listener, $this->_listeners) ) {
			$this->_listeners[count($this->_listeners)] = &$listener;
			return true;
		}
		
		return false;
	}
	
	public function detachListener(IListener &$listener) {
	}
	
	public function run($event = null) {
		foreach( $this->_listeners as $key => &$listener ) {
			$listener->update($this, $event);
		}
	}
}

interface IListener
{
	public function update(Subject &$subject, $event = null);
}

abstract class BaseListener implements IListener {
	public function update(Subject &$subject, $event = null) {
		print 'Event: ' . $event . ' --> ' . print_r( $subject, true ) . '<br />';
	}
}

class ListenerA extends BaseListener { }
class ListenerB extends BaseListener { }


$subject = new Subject();

$a = new ListenerA();
$subject->attachListener($a);

$b = new ListenerB();
$subject->attachListener($b);


print 'Example of Events and the Observer pattern, in most basic form.<br /><br />';

$subject->run('first-event');

$subject->run('second-event');

$subject->run('third-event');














