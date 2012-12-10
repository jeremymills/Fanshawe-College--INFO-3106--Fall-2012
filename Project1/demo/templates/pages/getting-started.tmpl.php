<p>This is an example of a Forms View Library. Every field within this form has been implemented using php. <em>Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</em></p>

<h1>Example 1: Generic Form</h1>
<dl class="tabs">
    <dd class="active"><a href="#render">Example</a></dd>
    <dd><a href="#description">Description</a></dd>
    <dd><a href="#code">Code</a></dd>
</dl>

<ul class="tabs-content">
    <li class="active" id="renderTab">
        <?php print $form; ?>
    </li>
    <li id="descriptionTab">
        <p><strong>Description Tab.</strong><br />This Generic form shows an example on when you would use simple name and email inputs. Along with a checkbox to determine whether or not someone has accepted your terms/conditions to continue on to the next pages. As well as a submit button to ensure the information has been submitted to the page.</p>
    </li>
    <li id="codeTab">
	<p><strong>Code Tab.</strong><br />Within this tab you will see the code that was necessary to generate the output you are viewing.</p>
        <pre style="background-color: #f2f2f2; border: 1px solid #d2d2d2; overflow: auto; width: 100%;">
&lt;?php
$form = new Mills\Form\Views\Form();
$form->addChild( new \Mills\Form\Fields\Views\Field('Name', new Mills\Form\Fields\Views\Text('name') ) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Email', new Mills\Form\Fields\Views\Email('email') ) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Accept Terms and Agreements?', new Mills\Form\Fields\Views\Checkbox('my-checkbox')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('', new Mills\Form\Fields\Views\Submit('submit', 'Send')) );

print $form;
        </pre>
    </li>
</ul>