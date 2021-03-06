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


use IrInboExtension\repository\PostMetaRepository;
use IrInboExtension\classes\InboTemplate;

/**
 * Class PostEstimateTimeBlockLoader
 * @package IrInboExtension\services
 * @author mohammad.ank@uotlook.com
 */
class PostEstimateTimeBlockLoader implements ServiceInterface{

    private $base_path;
    private $post_meta_repository;

    public function __construct($base_path)
    {
        $this->base_path = $base_path;
        $this->post_meta_repository = PostMetaRepository::get_instance();
    }

    function run()
    {
        add_action('ampforwp_before_post_content', array( $this ,'inbo_estimator_ampforwp_block_generator'));
        add_action('amp_post_template_css', array( $this ,'inbo_add_main_css'), 11);
        add_action('amp_post_template_head', array( $this ,'inbo_add_font_class'), 11);
    }

    function inbo_add_font_class(){
        $icon_pack = PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ICON_PACK_NAME);
        switch ($icon_pack){
            case 'font-awesome':
                if(PostTimeSettings::get_ampforwp_settings('ampforwp_font_icon') != 'fontawesome-icons') {
                    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
                    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
                        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
                        crossorigin="anonymous" referrerpolicy="no-referrer" />';
                }
                break;
            case 'none': break;
            default: //flat icon pack
                echo "<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>";
                break;
        }
    }

    function inbo_estimator_ampforwp_block_generator()
    {
        echo $this->get_estimator_block();
    }

    function inbo_add_main_css(){
        echo $this->inbo_main_css_initialize(get_the_ID());
    }

    function inbo_main_css_initialize($post_id): InboTemplate
    {
        $inbo_color = PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_COLOR)['color'];
        $container_style = PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ADVANCED_STYLE_CONTAINER);
        $icon_style = PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ADVANCED_STYLE_ICON);

        $block = new InboTemplate($this->base_path . "style/style.css.php");
        $block->inbo_color = ($inbo_color==null || $inbo_color==="")?"deepskyblue":$inbo_color;
        $block->container_style = $container_style;
        $block->icon_style = $icon_style;
        return $block;
    }

    function get_estimator_block()
    {
        global $wp_query;

        if ($wp_query && $wp_query->post) {
            $post = $wp_query->post;
            $round_time = $this->get_inbo_estimated_time($post);
            $icon_type = PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ICON_PACK_NAME);
            $icon = $this->get_icon_by_type($icon_type);

            $table = new InboTemplate($this->base_path . "view/estimator_template.php");
            $table->icon_type = $icon_type;
            $table->icon = $icon;
            $table->reading_time = $this->get_reading_time_text($round_time);
            return $table;
        }
        return "";
    }

    private function get_reading_time_text($time){
        if($time == 0) return PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_IN_LESS_THEN_ONE_MINUTE_TEXT);
        $text_template = PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_TEXT_TEMPLATE);
        return str_replace("{time}",$time,$text_template);
    }

    private function get_icon_by_type($icon_type): string
    {
        switch ($icon_type){
            case 'font-awesome':
                return PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ICON_CLASS_FONT_AWESOME);
            case 'none':
                return '';
            case 'custom-element':
                return PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ICON_HTML_ELEMENT);
            default: //flat icon pack
                return PostTimeSettings::get_ampforwp_settings(PostTimeSettings::$INBO_POSTS_TIME_ICON_CLASS_FLAT_ICON);
        }
    }

    private function get_inbo_estimated_time($post): float
    {
        $estimated_time = $this->post_meta_repository->get_inbo_estimated_time_post_meta($post->ID);
        if($estimated_time == null || $estimated_time == ''){
            $estimated_time = self::inbo_estimate_post_time($post);
            $this->post_meta_repository->set_inbo_estimated_time_post_meta($post->ID, $estimated_time);
        }
        return $estimated_time;
    }

    public static function inbo_estimate_post_time($post): float
    {
        $content_length = count(explode(' ', wp_strip_all_tags($post->post_content)));
        $time = $content_length / 200;
        return round($time);
    }
}