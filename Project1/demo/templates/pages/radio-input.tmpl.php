<p>This is an example of the Radio attribute within the Forms Library. Every field within this form has been implemented using php. <em>Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</em></p>

<h1>Example 5: Radio & Checkbox Form</h1>
<dl class="tabs">
    <dd class="active"><a href="#render">Example</a></dd>
    <dd><a href="#description">Description</a></dd>
    <dd><a href="#code">Code</a></dd>
</dl>

<ul class="tabs-content">
    <li class="active" id="renderTab">
	<p>Gender:</p>
        <?php print $form; ?>
    </li>
    <li id="descriptionTab">
        <p><strong>Description Tab.</strong><br />Radio Inputs & Checkbox's are used in this instance to retrieve the gender from the user. Which can than be stored within a database and viewed either on their personal profile or filed.</p>
    </li>
    <li id="codeTab">
	<p><strong>Code Tab.</strong><br />Within this tab you will see the code that was necessary to generate the output you are viewing.</p>
        <pre style="background-color: #f2f2f2; border: 1px solid #d2d2d2; overflow: auto; width: 100%;">
&lt;?php
$form = new Mills\Form\Views\Form();
$form->addChild( new \Mills\Form\Fields\Views\Field('Gender<br />Male', new Mills\Form\Fields\Views\Radio('radio')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Female', new Mills\Form\Fields\Views\Radio('radio')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Still Figuring It Out', new Mills\Form\Fields\Views\Radio('radio')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('<br />Are You Sure?', new Mills\Form\Fields\Views\Checkbox('checkbox')) );

print $form;
        </pre>
    </li>
</ul>