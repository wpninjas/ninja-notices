<?php

/*
 * Plugin Name: Ninja Notices
 */

final class NinjaNotices
{
    public function __construct()
    {
        add_action( 'init', array( $this, 'custom_post_type' ), 0 );
        add_shortcode( 'ninja_notice', array( $this, 'display_notice' ) );
        add_shortcode( 'ninja_notices', array( $this, 'display_notices' ) );
    }

    public function custom_post_type() {

        $labels = array(
            'name'                  => _x( 'Notices', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Notice', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Notices', 'text_domain' ),
            'name_admin_bar'        => __( 'Notices', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'All Items', 'text_domain' ),
            'add_new_item'          => __( 'Add New Item', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Item', 'text_domain' ),
            'edit_item'             => __( 'Edit Item', 'text_domain' ),
            'update_item'           => __( 'Update Item', 'text_domain' ),
            'view_item'             => __( 'View Item', 'text_domain' ),
            'search_items'          => __( 'Search Item', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Notice', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'revisions', 'custom-fields', ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-format-aside',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'ninja_notices', $args );

    }

    public function display_notice( $atts )
    {
        $atts = wp_parse_args( $atts, array( 'id' => NULL ) );

        $notice = get_post( $atts[ 'id' ] );
        $output = "<div style='display: block; padding: 20px; background-color: #DDD;'>{$notice->post_content}</div>";

        return $output;
    }

    public function display_notices( $atts )
    {
        $atts = wp_parse_args( $atts, array() );

        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'ninja_notices'
        );
        $output = '';
        foreach( get_posts( $args ) as $notice ){
            $output .= "<div style='display: block; padding: 20px; background-color: #DDD;'>{$notice->post_content}</div>";
        }

        return $output;
    }

}

new NinjaNotices();