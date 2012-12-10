<p>This is an example of text-input fields from without our Forms View Library. Every field within this form has been implemented using php. <em>Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</em></p>

<h1>Example 3: Text Field Input Form</h1>
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
        <p><strong>Description Tab.</strong><br />This form page shows you the text-input fields that allow you to input text. With this we would then take the information and store it into a database or send it as an e-mail confirmation to our WebAdmin.</p>
    </li>
    <li id="codeTab">
	<p><strong>Code Tab.</strong><br />Within this tab you will see the code that was necessary to generate the output you are viewing.</p>
        <pre style="background-color: #f2f2f2; border: 1px solid #d2d2d2; overflow: auto; width: 100%;">
&lt;?php
$form = new Mills\Form\Views\Form();
$form->addChild( new \Mills\Form\Fields\Views\Field('Home #: ', new Mills\Form\Fields\Views\Telephone('telephone')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Work #: ', new Mills\Form\Fields\Views\Telephone('telephone')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Cell #: ', new Mills\Form\Fields\Views\Telephone('telephone')) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Add Your Home Page: ', new Mills\Form\Fields\Views\URL('homepage')) );
$textArea = new \Mills\Form\Fields\Views\Field('Comments', new Mills\Form\Fields\Views\TextArea('name','5', '20'));
$form->addChild($textArea);

print $form;
        </pre>
    </li>
</ul>