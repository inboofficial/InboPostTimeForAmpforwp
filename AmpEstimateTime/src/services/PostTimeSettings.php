<?php


namespace IrInboExtension\services;


class PostTimeSettings implements ServiceInterface
{


    public function __construct()
    {
    }

    function run()
    {
//        add_filter("redux/options/redux_builder_amp/sections", array( $this , 'inbo_posts_time_in_amp_settings'));
        add_filter("redux/options/redux_builder_amp/sections",  array( $this ,'inbo_posts_time_in_amp_settings'));
    }

    function inbo_posts_time_in_amp_settings($sections)
    {
        $sections[] = array(
            'title' => esc_html__('Inbo Post Time', 'floating-button-for-amp'),
            'icon' => 'el el-cog',
            'id' => 'floating-btn-subsection',
        );
        $sections[] = array(
            'title' => esc_html__('Settings', 'floating-button-for-amp'),
            'id' => 'floating-btn-settings',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'floating-btn-settings-accordion',
                    'type' => 'section',
                    'title' => esc_html__('Floating Button Settings', 'floating-button-for-amp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => 'floating-btn-icon',
                    'type' => 'select',
                    'title' => esc_html__('Select a Button', 'floating-button-for-amp'),
                    'options' => array(
                        '1' => 'WhatsApp',
                        '2' => 'Call Now',
                        '3' => 'Custom Icons',
                        '4' => 'Custom Image',
                    ),
                ),
                array(
                    'id' => 'floating-btn-link-whatsapp',
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Phone Number ( With Country Code )', 'floating-button-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter Phone Number With Your Country Code ( example :+917507xxxxxx)', 'floating-button-for-amp'),
                    'required' => array('floating-btn-icon', '=', '1')
                ),
                array(
                    'id' => 'floating-btn-link-whatsapp-message',
                    'type' => 'textarea',
                    'title' => esc_html__('Message Content', 'floating-button-for-amp'),
                    'tooltip-subtitle' => esc_html__('Enter text to send as a message on whatsapp', 'floating-button-for-amp'),
                    'required' => array('floating-btn-icon', '=', '1')
                ),
                array(
                    'id' => 'floating-btn-link-call',
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Phone Number', 'floating-button-for-amp'),
                    'required' => array('floating-btn-icon', '=', '2')
                ),
                array(
                    'id' => 'floating-btn-icon-select-field',
                    'type' => 'icon_select',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Select an Icon ', 'floating-button-for-amp'),
                    'default' => '',
                    'required' => array('floating-btn-icon', '=', '3'),
                ),
                array(
                    'id' => 'floating-btn-image',
                    'type' => 'media',
                    'class' => 'child_opt child_opt_arrow',
                    'url' => true,
                    'title' => esc_html__('Upload Image', 'floating-button-for-amp'),
                    'required' => array('floating-btn-icon', '=', '4'),
                ),
                array(
                    'id' => 'floating-btn-icon-color',
                    'title' => esc_html__('Color', 'floating-button-for-amp'),
                    'type' => 'color_rgba',
                    'class' => 'child_opt child_opt_arrow',
                    'default' => array(
                        'color' => '#005be2',
                    ),
                    'required' => array('floating-btn-icon', '!=', '4'),
                ),
                array(
                    'id' => 'floating-btn-icon-bgcolor',
                    'title' => esc_html__('Background Color', 'floating-button-for-amp'),
                    'type' => 'color_rgba',
                    'class' => 'child_opt child_opt_arrow',
                    'default' => array(
                        'color' => '#FFF',
                    ),
                    'required' => array('floating-btn-icon', '!=', '4'),
                ),
                array(
                    'id' => 'floating-btn-link-custom',
                    'type' => 'text',
                    'title' => esc_html__('Link', 'floating-button-for-amp'),
                    'class' => 'child_opt child_opt_arrow',
                    'default' => '#',
                    'required' => array('floating-btn-icon', '=', '3')
                ),

                array(
                    'id' => 'floating-btn-link-image',
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Link', 'floating-button-for-amp'),
                    'default' => '#',
                    'required' => array('floating-btn-icon', '=', '4')
                ),
                array(
                    'id' => 'floating-btn-position-accordion',
                    'type' => 'section',
                    'title' => esc_html__('Floating Button Position', 'floating-button-for-amp'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open' => 1,
                ),
                array(
                    'id' => 'floating-btn-position',
                    'type' => 'select',
                    'title' => esc_html__('Position', 'floating-button-for-amp'),
                    'options' => array(
                        '1' => 'Bottom Right',
                        '2' => 'Bottom Left'
                    ),
                    'default' => '1',
                ),
                array(
                    'id' => 'floating-btn-right',
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Right', 'floating-button-for-amp'),
                    'default' => '1',
                    'required' => array('floating-btn-position', '=', '1')
                ),
                array(
                    'id' => 'floating-btn-left',
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Left', 'floating-button-for-amp'),
                    'default' => '5',
                    'required' => array('floating-btn-position', '=', '2')
                ),
                array(
                    'id' => 'floating-btn-bottom',
                    'type' => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title' => esc_html__('Bottom', 'floating-button-for-amp'),
                    'default' => '12'
                ),

            )
        );
        return $sections;
    }

}