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
        <? if ($icon_type == 'google-icon') { ?>
            <div class="icon-container">
                <i class="material-icons"><? echo esc_html__($icon) ?> </i>
            </div>
            <?
        } elseif ($icon_type == 'font-awesome') {
            ?>
            <div class="icon-container">
                <i class="<? echo esc_html__($icon) ?>"></i>
            </div>
            <?
        } elseif ($icon_type != 'none') {
            ?>
            <div class="icon-container">
                <i class="<? echo esc_html__($icon) ?>"></i>
            </div>
        <? } ?>
       زمان مطالعه:
        <? echo esc_html__($miniute); ?>
        دقیقه</span></div>

