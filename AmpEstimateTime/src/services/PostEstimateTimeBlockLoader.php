<?php


namespace IrInboExtension\services;


use IrInboExtension\repository\PostMetaRepository;
use IrInboExtension\classes\InboTemplate;

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
        add_action('ampforwp_before_post_content', array( $this ,'inbo_estimator_amp_block_generator'));
        add_action('amp_post_template_css', array( $this ,'inbo_add_main_css'), 11);
    }

    function inbo_estimator_amp_block_generator()
    {
        echo $this->get_estimator_block();
    }

    function inbo_add_main_css(){
        echo $this->inbo_main_css_initialize(get_the_ID());
    }

    function inbo_main_css_initialize($post_id): InboTemplate
    {
        $inbo_color = $inbo_color = ampforwp_get_setting('inbo-posts-time-color')['color'];

        $block = new InboTemplate($this->base_path . "style/style.css.php");
        $block->inbo_color = ($inbo_color==null || $inbo_color==="")?"deepskyblue":$inbo_color;
        return $block;
    }

    function get_estimator_block()
    {
        global $wp_query;

        if ($wp_query && $wp_query->post) {
            $post = $wp_query->post;
            $round_time = $this->get_inbo_estimated_time($post);

            $table = new InboTemplate($this->base_path . "view/estimator_template.php");
            if ($round_time == 0) {
                $table->miniute = "کم تر از 1 ";
            } else {
                $table->miniute = $round_time;
            }
            return $table;
        }
        return "";
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