<?php
/**
 * estimator
 * @package             PluginPackage
 * @author              mohammad ali nassiri
 * @copyright           please_do_not_copy
 *
 */

?>


<div class="et-ico">
    <span class="eti-ico hour-glass">
        <? if ($icon_type == 'font-awesome') {
            ?>
            <div class="icon-container">
                <i class="<? echo esc_html__($icon) ?>"></i>
            </div>
            <?
        } elseif ($icon_type == 'custom-element'){ ?>
            <div class="icon-container">
                <? echo $icon ?>
            </div>
        <?} elseif ($icon_type != 'none') {
            ?>
            <div class="icon-container">
                <i class="<? echo esc_html__($icon) ?>"></i>
            </div>
        <? } ?>
    <? echo $reading_time; ?>
    </span></div>

