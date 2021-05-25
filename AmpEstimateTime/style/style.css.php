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
div.et-ico {
    <? echo esc_html__($container_style) ?>
}
/*icon style*/
span.inbo_estimator_icon {
<? echo esc_html__($icon_style) ?>
}
/**/
/*span.eti-ico:before {*/
/*    content: "\f469";*/
/*}*/
/**/

