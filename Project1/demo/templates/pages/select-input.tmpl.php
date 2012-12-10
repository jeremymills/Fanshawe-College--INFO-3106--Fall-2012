<p>This is an example of our Select Input Forms View Library. Every field within this form has been implemented using php. <em>Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</em></p>

<h1>Example 4: Select Input Form</h1>
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
        <p><strong>Description Tab.</strong><br />This page is generated to simply use a select/option input style to retrieve the date of month you were born in.</p>
    </li>
    <li id="codeTab">
	<p><strong>Code Tab.</strong><br />Within this tab you will see the code that was necessary to generate the output you are viewing.</p>
        <pre style="background-color: #f2f2f2; border: 1px solid #d2d2d2; overflow: auto; width: 100%;">
&lt;?php
$select = new \Mills\Form\Fields\Views\Select('my-select', array(
	new \Mills\Form\Fields\Views\Option('January', 'january'),
	new \Mills\Form\Fields\Views\Option('February', 'february'),
	new \Mills\Form\Fields\Views\Option('March', 'march'),
	new \Mills\Form\Fields\Views\Option('April', 'april'),
	new \Mills\Form\Fields\Views\Option('May', 'may'),
	new \Mills\Form\Fields\Views\Option('June', 'june'),
	new \Mills\Form\Fields\Views\Option('July', 'july'),
	new \Mills\Form\Fields\Views\Option('August', 'august'),
	new \Mills\Form\Fields\Views\Option('September', 'september'),
	new \Mills\Form\Fields\Views\Option('October', 'october'),
	new \Mills\Form\Fields\Views\Option('November', 'november'),
	new \Mills\Form\Fields\Views\Option('December', 'december')
));
$form->addChild( new \Mills\Form\Fields\Views\Field('Please Select The Month You Were Born In', $select) );

print $form;
        </pre>
    </li>
</ul>