<?php


namespace IrInboExtension\services;


use IrInboExtension\classes\InboTemplate;

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
    public static $INBO_POSTS_TIME_ICON_CLASS_GOOGLE_ICON = 'inbo-posts-time-icon-class-google-icon';

    public function __construct($base_path)
    {
        $this->base_path = $base_path;
    }

    public static function get_amp_settings($setting_name){
        return ampforwp_get_setting($setting_name);
    }

    function run()
    {
        add_filter("redux/options/redux_builder_amp/sections",  array( $this ,'inbo_posts_time_in_amp_settings'));
    }

    function inbo_posts_time_in_amp_settings($sections)
    {
        $sections[] = array(
            'title' => esc_html__('Inbo Post Time', 'inbo-posts-time-for-amp'),
            'icon' => 'el el-cog',
            'id' => 'floating-btn-subsection',
        );
        $sections[] = array(
            'title' => esc_html__('Settings', 'inbo-posts-time-for-amp'),
            'id' => 'inbo-posts-time-settings',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'inbo-posts-time-settings-accordion',
                    'type' => 'section',
                    'title' => esc_html__('Inbo Post Time Style', 'inbo-posts-time-for-amp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_STYLING_LEVEL,
                    'type' => 'select',
                    'title' => esc_html__('Styling level', 'inbo-posts-time-for-amp'),
                    'options' => array(
                        '1' => 'simple',
                        '2' => 'advance',
                    ),
                    'default' => '1'
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ADVANCED_STYLE_CONTAINER,
                    'type' => 'textarea',
                    'title' => esc_html__('Time estimate container style', 'inbo-posts-time-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter Your Style For Estimator Container', 'inbo-posts-time-for-amp'),
                    'required' => array('inbo-posts-time-styling-level', '=', '2'),
                    'default' => $this->get_body_default_style()
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ADVANCED_STYLE_ICON,
                    'type' => 'textarea',
                    'title' => esc_html__('Time estimate icon style', 'inbo-posts-time-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter Your Style For Estimator icon', 'inbo-posts-time-for-amp'),
                    'required' => array('inbo-posts-time-styling-level', '=', '2'),
                    'default' => $this->get_icon_default_style()
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_COLOR,
                    'title' => esc_html__('Background Color', 'inbo-posts-time-for-amp'),
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
                    'title' => esc_html__('Icon Settings', 'inbo-posts-time-for-amp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_PACK_NAME,
                    'type' => 'select',
                    'title' => esc_html__('Icon Pack', 'inbo-posts-time-for-amp'),
                    'options' => array(
                        'none' => 'None',
                        'font-awesome' => 'Font-Awesome',
                        'flat-icon' => 'Flat Icon',
                        'google-icon' => 'Google Icons'
                    ),
                    'default' => 'flat-icon',
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_CLASS_FLAT_ICON,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Icon Class', 'inbo-posts-time-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter Icon Pack Class Name Here, find classes here: flaticon.com/uicons', 'inbo-posts-time-for-amp'),
                    'required' => array(self::$INBO_POSTS_TIME_ICON_PACK_NAME, '=', 'flat-icon'),
                    'default' => 'fi-rr-stopwatch',
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_CLASS_FONT_AWESOME,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Icon Class', 'inbo-posts-time-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter Icon Pack Class Name, find classes here: fontawesome.com', 'inbo-posts-time-for-amp'),
                    'required' => array(self::$INBO_POSTS_TIME_ICON_PACK_NAME, '=', 'font-awesome'),
                    'default' => 'far fa-clock',
                ),
                array(
                    'id' => self::$INBO_POSTS_TIME_ICON_CLASS_GOOGLE_ICON,
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Icon Class', 'inbo-posts-time-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter Icon Name Here, find classes here: fonts.google.com/icons', 'inbo-posts-time-for-amp'),
                    'required' => array(self::$INBO_POSTS_TIME_ICON_PACK_NAME, '=', 'google-icon'),
                    'default' => 'timer',
                ),

            )
        );
        return $sections;
    }

    private function get_body_default_style(): string
    {
        return <<<TEXT
            background-color: var(--inbo-color);
            border-radius: 0.4rem;
            text-align: center;
            color: white;
        TEXT;

    }

    private function get_icon_default_style(): string
    {
        return <<<TEXT
            position: static;
            display: inline-block;
            vertical-align: middle;
            padding-bottom: 2px;
            font-size: 1.5rem;
            color: white;
            padding-left: 0.5rem;
        TEXT;

    }

}