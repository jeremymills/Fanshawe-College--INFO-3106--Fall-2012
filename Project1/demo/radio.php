<?php
/**
 * @ignore
 */
define('IN_DEMO', true);
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require_once ROOT_PATH . 'bootstrap.php';

/* Create a new template view instance */
$template = new Demo\Views\Template();
$template->navigationItem('radio-checkbox-inputs', array('#active' => true));

/* Append / set the child (contents) */
$page = new Demo\Views\Pages\GettingStarted4();

/* Build the form ... */
//add new form container to the website
$form = new Mills\Form\Views\Form();
/*
 *add fields to the form container
 */
//add name text field with label
//$form->addChild( new \Mills\Form\Fields\Views\Field('Name: ', new Mills\Form\Fields\Views\Text('name') ) );
//add email text field with label
//$form->addChild( new \Mills\Form\Fields\Views\Field('Email: ', new Mills\Form\Fields\Views\Email('email') ) );
//add telephone input type
//$form->addChild( new \Mills\Form\Fields\Views\Field('Home #: ', new Mills\Form\Fields\Views\Telephone('telephone')) );
//add telephone input type
//$form->addChild( new \Mills\Form\Fields\Views\Field('Work #: ', new Mills\Form\Fields\Views\Telephone('telephone')) );
//add telephone input type
//$form->addChild( new \Mills\Form\Fields\Views\Field('Cell #: ', new Mills\Form\Fields\Views\Telephone('telephone')) );
//add radio buttons
$form->addChild( new \Mills\Form\Fields\Views\Field('Male', new Mills\Form\Fields\Views\Radio('radio')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Female', new Mills\Form\Fields\Views\Radio('radio')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Still Figuring It Out', new Mills\Form\Fields\Views\Radio('radio')) );
//add checkbox with label
$form->addChild( new \Mills\Form\Fields\Views\Field('<br />Are You Sure?', new Mills\Form\Fields\Views\Checkbox('checkbox')) );
//add select box with label
/* $select = new \Mills\Form\Fields\Views\Select('my-select', array(
	new \Mills\Form\Fields\Views\Option('You see', 'you-see'),
	new \Mills\Form\Fields\Views\Option('this don\'t you?', 'dont-you')
));
$form->addChild( new \Mills\Form\Fields\Views\Field('My select box', $select) ); */

//add button with label and button value
//$form->addChild( new \Mills\Form\Fields\Views\Field('', new Mills\Form\Fields\Views\Button('my-button', 'Just Click It!')) );
//add submit button with value
//$form->addChild( new \Mills\Form\Fields\Views\Field('', new Mills\Form\Fields\Views\Submit('submit', 'Send')) );
//add hidden field with value
//$form->addChild( new \Mills\Form\Fields\Views\Field('Hidden Field: ', new Mills\Form\Fields\Views\Hidden('London', 'Ontario')) );
//add number field with value
//$form->addChild( new \Mills\Form\Fields\Views\Field('Year Born: ', new Mills\Form\Fields\Views\Number('Quantity')) );
//add URL field with value
//$form->addChild( new \Mills\Form\Fields\Views\Field('Add Your Home Page: ', new Mills\Form\Fields\Views\URL('homepage')) );
//add textarea field with value
/*$textArea = new \Mills\Form\Fields\Views\Field('Comments', new Mills\Form\Fields\Views\TextArea('name','5', '20'));
$form->addChild($textArea); */
//add reset field with value
//$form->addChild( new \Mills\Form\Fields\Views\Field('', new Mills\Form\Fields\Views\Reset('Reset Page')) );


/* Add the form to the page view */
$page->set('form', $form);

/* Add the page view to the template view */
$template->content( $page );

/* Render the template */
print $template;