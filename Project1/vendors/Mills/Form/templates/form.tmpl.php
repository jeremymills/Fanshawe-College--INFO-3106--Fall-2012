<?php defined('IN_LIBRARY') or exit; ?>

<form method="<?php print $view->method(); ?>" action="<?php print $view->action(); ?>">

<?php foreach( $fields as $field ) : ?>

<p><?php print $field->render(); ?></p>

<?php endforeach; ?>

</form>