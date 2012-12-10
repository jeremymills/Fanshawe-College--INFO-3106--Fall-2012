<p>This is an example of form elements from within our Forms View Library. Every field within this form has been implemented using php. <em>Maecenas at dolor quam, non elementum turpis. Curabitur elementum orci nec orci lacinia vestibulum. Curabitur mi metus, feugiat sit amet placerat sit amet, gravida eget mi. In ut dolor vitae nibh euismod egestas.</em></p>

<h1>Example 2: Form Element</h1>
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
        <p><strong>Description Tab.</strong><br />This Element form shows the fields that were printed in the home page, transfering the information you provided onto a new page using the Hidden field.</p>
    </li>
    <li id="codeTab">
	<p><strong>Code Tab.</strong><br />Within this tab you will see the code that was necessary to generate the output you are viewing.</p>
        <pre style="background-color: #f2f2f2; border: 1px solid #d2d2d2; overflow: auto; width: 100%;">
&lt;?php
$form = new Mills\Form\Views\Form();
$form->addChild( new \Mills\Form\Fields\Views\Field('Welcome: ', new Mills\Form\Fields\Views\Text('name') ) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Email on File: ', new Mills\Form\Fields\Views\Email('email') ) );
$form->addChild( new \Mills\Form\Fields\Views\Field('Hidden Field: ', new Mills\Form\Fields\Views\Hidden('name', 'London')) );

print $form;
        </pre>
    </li>
</ul>