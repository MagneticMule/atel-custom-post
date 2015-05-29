<?php


class Atel_Post_Manager
{
    /**
     * An array of labels for this post type. By default, post labels are used for non-hierarchical post types and page labels for hierarchical ones.
     * if empty, 'name' is set to value of 'label', and 'singular_name' is set to value of 'name'.
     *
     * @var array
     */
    private $labels;

    /**
     * @var array
     */
    private $attributes;

    /**
     * Tag identifier used by file includes and selector attributes.
     *
     * @var string
     */
    protected $tag = 'AtelCustomPost';

    /**
     * Friendly name used to identify the plugin.
     *
     * @var string
     */
    protected $name = 'atelpost';

    /**
     * Current version of the plugin.
     *
     * @var string
     */
    protected $version = '0.1.1';

    /**
     * Default Constructor.
     */
    public function __construct()
    {
    }

    public function setLabels()
    {
    }

    public function getLabels()
    {
    }

    public function getAttributes()
    {
    }

    public function setAttributes()
    {
    }

    /**
     * Our taxonomy will include classes that students
     * can be part of as well as activities that students can participate in.
     */
    public function customTaxonomy()
    {
        register_taxonomy(
            'classes',
            'activities',
            array(
                'hierarchical' => true,
                'label' => 'Classes',
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'classes',
                    'with_front' => true,
                ),
            )
        );
    }

     /**
      * Defines an array of labels to pass to the
      * ref: https://codex.wordpress.org/Function_Reference/register_post_type.
      **/
     public function buildCustomPost()
     {
         $labels = array(
            'name' => ('Activities'),
            'singular_name' => ('Activity'),
            'add_new' => ('Add New'),
            'add_new_item' => ('Add New Activity'),
            'edit_item' => ('Edit Activities'),
            'new_item' => ('New Activity'),
            'view_item' => ('View Activity'),
            'not_found' => ('No Activities found'),
            'not_found_in_trash' => ('No Activities found in Trash'),
            'parent_item_colon' => ('Parent Activity:'),
            'menu_name' => ('Activities'),
            );

         $customPostArgs = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'Activities for language learners filterable by Student class',
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
            'taxonomies' => array('classes'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-playlist-audio',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            );
         register_post_type('atel_activities', $customPostArgs);
     }

    /**
     * The 'register_post_type' function needs to be called during the WP init phase of execution.
     * note, when using this in a class based plugin we need to define the callback class "which is always $this" via an array.
     **/
    public function registerCustomPost()
    {
        add_action('init', array($this, 'buildCustomPost'));
    }
}
