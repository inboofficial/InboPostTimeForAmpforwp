<?php
/**
 *
 * @package             PluginPackage
 * @author              mohammad ali nassiri
 * @copyright           please_do_not_copy
 *
 */

?>

:root {
    --inbo-color: <? echo esc_html__($inbo_color); ?>;
}
div.et-ico {
    background-color: var(--inbo-color);
    border-radius: 0.4rem;
    text-align: center;
    color: white;
}
span.inbo_estimator_icon {
    display: inline-block;
    vertical-align: middle;
    padding-bottom: 2px;
    padding-left: 2px;
}

span.eti-ico:before {
    content: "\f469";
    font-family: "icomoon";
    font-size: 1.5rem;
    display: inline-block;
    color: white;
    vertical-align: middle;
    padding-left: 0.5rem;
}


