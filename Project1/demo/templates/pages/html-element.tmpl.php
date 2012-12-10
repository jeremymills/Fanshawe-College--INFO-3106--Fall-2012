<p>This is an example of all new HTML5 elements. Every field within this form has been implemented using php. <em>Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</em></p>

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
        <p>Description Tab. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</p>
    </li>
    <li id="codeTab">
	<p>Code Tab. Within this tab you will see the code that was necessary to generate the output you are viewing.</p>
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