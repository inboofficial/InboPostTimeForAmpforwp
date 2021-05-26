<?php
/**
 * Inbo Post Time For ampforwp is free software:
 * you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation,
 * either version 2 of the License, or any later version.
 *
 * Inbo Post Time For ampforwp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Inbo Post Time For ampforwp. If not, see <https://www.gnu.org/licenses/>.
 */


namespace IrInboExtension\services;


use IrInboExtension\classes\InboTemplate;

/**
 * Class PostTimeSettings
 * @package IrInboExtension\services
 * @author mohammad.ank@outlook.com
 */
class PostTimeSettings implements ServiceInterface
{


    private $base_path;

    public static $INBO_POSTS_TIME_STYLING_LEVEL = 'inbo-posts-time-styling-level';
    public static $INBO_POSTS_TIME_ADVANCED_STYLE_CONTAINER = 'inbo-posts-time-advanced-style-container';
    public static $INBO_POSTS_TIME_ADVANCED_STYLE_ICON = 'inbo-posts-time-advanced-style-icon';
    public static $INBO_POSTS_TIME_COLOR = 'inbo-posts-time-color';
    public static $INBO_POSTS_TIME_ICON_PACK_NAME = 'inbo-posts-time-icon-pack-name';
    public static $INBO_POSTS_TIME_ICON_CLASS_FLAT_ICON = 'inbo-posts-time-icon-class-flat-icon';
    public static $INBO_POSTS_TIME_ICON_CLASS_FONT_AWESOME = 'inbo-posts-time-icon-class-font-awesome';
    public static $INBO_POSTS_TIME_TEXT_TEMPLATE = 'inbo-posts-time-text-template';
    public static $INBO_POSTS_TIME_IN_LESS_THEN_ONE_MINUTE_TEXT = 'inbo-posts-time-in-less-then-one-minute-text';
    public static $INBO_POSTS_TIME_ICON_HTML_ELEMENT = 'inbo-posts-time-icon-html-element';


    public function __construct($base_path)
    {
        $this->base_path = $base_path;
    }

    public static function get_ampforwp_settings($setting_name){
        return ampforwp_get_setting($setting_name);
    }

    function run()
    {
        add_filter("redux/options/redux_builder_amp/sections",  array( $this ,'inbo_posts_time_in_ampforwp_settings'));
    }

    function inbo_posts_time_in_ampforwp_settings($sections)
    {
        $sections[] = array(
            'title' => esc_html__('Inbo Post Time', 'inbo-posts-time-for-ampforwp'),
            'icon' => 'el el-cog',
            'id' => 'floating-btn-subsection',
        );
        $sections[] = array(
            'title' => esc_html__('Settings', 'inbo-posts-time-for-ampforwp'),
            'id' => 'inbo-posts-time-settings',
            'subsection' => true,
            'fields' => array(

                array(
                    'id' => 'inbo-posts-time-settings-accordion',
                    'type' => 'section',
                    'title' => esc_html__('Inbo Post Time Style', 'inbo-posts-time-for-ampforwp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_STYLING_LEVEL,
                    'type' => 'select',
                    'title' => esc_html__('Styling level', 'inbo-posts-time-for-ampforwp'),
                    'options' => array(
                        '1' => 'simple',
                        '2' => 'advance',
                    ),
                    'default' => '1'
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ADVANCED_STYLE_CONTAINER,
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => esc_html__('Time estimate container style', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('Enter Your Style For Estimator Container', 'inbo-posts-time-for-ampforwp'),
                    'required' => array('inbo-posts-time-styling-level', '=', '2'),
                    'default' => $this->get_body_default_style()
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ADVANCED_STYLE_ICON,
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => esc_html__('Time estimate icon style', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('Enter Your Style For Estimator icon', 'inbo-posts-time-for-ampforwp'),
                    'required' => array('inbo-posts-time-styling-level', '=', '2'),
                    'default' => $this->get_icon_default_style()
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_COLOR,
                    'title' => esc_html__('Background Color', 'inbo-posts-time-for-ampforwp'),
                    'type' => 'color_rgba',
                    'class' => 'child_opt child_opt_arrow',
                    'default' => array(
                        'color' => 'deepskyblue',
                    ),
                    'required' => array('inbo-posts-time-styling-level', '=', '1')
                ),
                array(
                    'id' => 'inbo-posts-time-icon-settings',
                    'type' => 'section',
                    'title' => esc_html__('Icon Settings', 'inbo-posts-time-for-ampforwp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_PACK_NAME,
                    'type' => 'select',
                    'title' => esc_html__('Icon Pack Loading', 'inbo-posts-time-for-ampforwp'),
                    'options' => array(
                        'none' => 'None',
                        'font-awesome' => 'Font-Awesome',
                        'flat-icon' => 'Flat Icon',
                        'custom-element' => "Custom Element",
                    ),
                    'default' => 'flat-icon',
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_HTML_ELEMENT,
                    'type' => 'ace_editor',
                    'mode' => 'html',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Icon Class', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('Enter the html element for icon', 'inbo-posts-time-for-ampforwp'),
                    'required' => array(self::$INBO_POSTS_TIME_ICON_PACK_NAME, '=', 'custom-element'),
                    'default' => $this->get_default_custom_html(),
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_CLASS_FLAT_ICON,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Icon Class', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('Enter Icon Pack Class Name Here, find classes here: flaticon.com/uicons', 'inbo-posts-time-for-ampforwp'),
                    'required' => array(self::$INBO_POSTS_TIME_ICON_PACK_NAME, '=', 'flat-icon'),
                    'default' => 'fi-rr-stopwatch',
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_CLASS_FONT_AWESOME,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Icon Class', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('Enter Icon Pack Class Name, find classes here: fontawesome.com', 'inbo-posts-time-for-ampforwp'),
                    'required' => array(self::$INBO_POSTS_TIME_ICON_PACK_NAME, '=', 'font-awesome'),
                    'default' => 'far fa-clock',
                ),
                array(
                    'id' => 'inbo-posts-time-text-settings',
                    'type' => 'section',
                    'title' => esc_html__('Icon Settings', 'inbo-posts-time-for-ampforwp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_TEXT_TEMPLATE,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Reading Time Text Template', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('use {time} to replace with calculated time', 'inbo-posts-time-for-ampforwp'),
                    'default' => 'Reading Time: {time} Minutes',
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_IN_LESS_THEN_ONE_MINUTE_TEXT,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('LessThenOne Minutes Text', 'inbo-posts-time-for-ampforwp'),
                    'tooltip-subtitle' => esc_html__('enter a text to show when calculated time is less then one minutes', 'inbo-posts-time-for-ampforwp'),
                    'default' => 'Reading Time: Less Then One Minutes',
                ),
            )
        );
        return $sections;
    }

    private function get_body_default_style(): string
    {
        return <<<CSS
            div.et-ico{
                background-color: var(--inbo-color);
                border-radius: 0.4rem;
                text-align: center;
                color: white;
            }
        CSS;

    }

    private function get_icon_default_style(): string
    {
        return <<<CSS
            div.icon-container i{
                position: static;
                display: inline-block;
                vertical-align: middle;
                padding-bottom: 2px;
                font-size: 1.2rem;
                color: white;
                padding-left: 0.5rem;
            }
        CSS;
    }

    private function get_default_custom_html() : string
    {
        return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;width: 20px;height: 20px;vertical-align: middle;padding-bottom: 2px; xml:space="preserve"><g>
                <g xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <g>
                            <path d="M391.84,48.87l54.306,45.287c3.739,3.119,8.281,4.641,12.798,4.641c5.729,0,11.415-2.448,15.371-7.191     c7.074-8.483,5.932-21.095-2.552-28.169L417.457,18.15c-8.481-7.074-21.094-5.933-28.169,2.551     C382.214,29.184,383.356,41.795,391.84,48.87z" fill="#ffffff" data-original="#000000" style=""/>
                            <path d="M53.057,98.797c4.516,0,9.059-1.522,12.798-4.641L120.16,48.87c8.483-7.074,9.626-19.686,2.552-28.169     c-7.073-8.482-19.686-9.625-28.169-2.551L40.237,63.437c-8.483,7.074-9.626,19.686-2.552,28.169     C41.642,96.349,47.328,98.797,53.057,98.797z" fill="#ffffff" data-original="#000000" style=""/>
                            <path d="M422.877,109.123C383.051,69.297,331.494,45.474,276,40.847V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20.847     c-55.494,4.627-107.051,28.449-146.877,68.275C44.548,153.697,20,212.962,20,276s24.548,122.303,69.123,166.877     C133.697,487.452,192.962,512,256,512c50.754,0,99.118-15.869,139.864-45.894c8.893-6.552,10.789-19.072,4.237-27.965     c-6.553-8.894-19.074-10.789-27.966-4.237C338.313,458.827,298.154,472,256,472c-108.075,0-196-87.925-196-196S147.925,80,256,80     s196,87.925,196,196c0,33.01-8.354,65.638-24.161,94.356c-5.326,9.677-1.799,21.839,7.878,27.165     c9.674,5.324,21.838,1.8,27.165-7.878C481.931,355.032,492,315.735,492,276C492,212.962,467.452,153.697,422.877,109.123z" fill="#ffffff" data-original="#000000" style=""/>
                            <path d="M353.434,155.601c-8.584-6.947-21.178-5.622-28.128,2.965l-63.061,77.925C260.209,236.17,258.124,236,256,236     c-22.056,0-40,17.944-40,40c0,22.056,17.944,40,40,40c22.056,0,40-17.944,40-40c0-5.052-0.951-9.884-2.668-14.338l63.067-77.933     C363.348,175.142,362.021,162.548,353.434,155.601z" fill="#ffffff" data-original="#000000" style=""/>
                        </g>
                    </g>
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                <g xmlns="http://www.w3.org/2000/svg">
                </g>
                </g></svg>
        HTML;

    }

}