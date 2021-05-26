<?php
/**
 *
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
 *
 */


namespace IrInboExtension\repository;

/**
 * Class PostMetaRepository
 * @package IrInboExtension\repository
 * @author mohammad.ank@outlook.com
 */
class PostMetaRepository
{
    public const INBO_ESTIMATED_TIME_POST_META_KEY_NAME = '_INBO_ESTIMATED_TIME_POST_META_KEY';

    private static $instance = null;

    /**
     * PostMetaRepository constructor.
     */
    public function __construct()
    {
        add_action('init',  array( $this ,'inbo_register_custom_meta'));
    }

    // register custom meta tag field
    function inbo_register_custom_meta()
    {
        register_post_meta('post',  self::INBO_ESTIMATED_TIME_POST_META_KEY_NAME
            , array(
                'show_in_rest' => true,
                'single' => true,
                'type' => 'string',
                'auth_callback' => function () {
                    return current_user_can('edit_posts');
                }
            ));
    }

    public static function get_instance(): self
    {
        if (self::$instance == null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get_inbo_estimated_time_post_meta($post_id)
    {
        return get_post_meta($post_id, self::INBO_ESTIMATED_TIME_POST_META_KEY_NAME, true);
    }

    public function set_inbo_estimated_time_post_meta($post_id, $data)
    {
        $sanitized_data = sanitize_text_field($data);
        update_post_meta($post_id, self::INBO_ESTIMATED_TIME_POST_META_KEY_NAME, $sanitized_data);
    }

    public function uninstall(){
        delete_metadata( 'post', 0, self::INBO_ESTIMATED_TIME_POST_META_KEY_NAME, false, true );
    }

}