<?php
/**
 *
 * @package             PluginPackage
 * @author              mohammad ali nassiri
 * @copyright           please_do_not_copy
 *
 */

?>

/*main color setup*/
:root {
    --inbo-color: <? echo esc_html__($inbo_color); ?>;
}
/*text style*/
<? echo esc_html__($container_style) ?>

/*icon style*/
<? echo esc_html__($icon_style) ?>

div.icon-container {
    display: inline;
    vertical-align: middle;
}

