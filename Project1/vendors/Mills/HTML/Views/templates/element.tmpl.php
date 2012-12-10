<?php defined('IN_LIBRARY') or exit; ?>
<<?php print $view->name() . ' ' . $attributes; ?><?php if( $view->isEmpty() ) : ?> /><?php else : ?>>
    <?php if( $view->hasChildren() ) : foreach( $view->children() as $child ) : ?>
        <?php print $child; ?>
    <?php endforeach; endif; ?>
</<?php print $view->name(); ?>>
<?php endif; ?>