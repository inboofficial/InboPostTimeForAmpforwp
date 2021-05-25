<?php
/**
 * estimator
 * @package             PluginPackage
 * @author              mohammad ali nassiri
 * @copyright           please_do_not_copy
 *
 */

?>


<div class="et-ico"><span class="eti-ico hour-glass">
        <?if( $icon_type == 'google-icon'){?>
        <i class="material-icons"><? echo esc_html__($icon) ?> </i>
        <?}
        elseif($icon_type !='none'){?>
        <i class="<? echo esc_html__($icon) ?>"></i>
        <?}?>
       زمان مطالعه:
        <? echo esc_html__($miniute); ?>
        دقیقه</span></div>

