<?php


class Atel_Post_Manager {
    /**
     * An array of labels for this post type. By default, post labels are used for non-hierarchical post types and page labels for hierarchical ones.
     * if empty, 'name' is set to value of 'label', and 'singular_name' is set to value of 'name'.
     *
     * @var array
     */
    private $labels;


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
       $this->labels = array(
        'name' => ('Activities'),
        'singular_name' => ('Activity'),
        'add_new' => ('Add New'),
        'add_new_item' => ('Add New Activity'),
        'edit' => ('Edit'),
        'edit_item' => ('Edit Activities'),
        'new_item' => ('New Activity'),
        'view_item' => ('View Activity'),
        'view' => ('View'),
        'not_found' => ('No Activities found'),
        'not_found_in_trash' => ('No Activities found in Trash'),
        'menu_name' => ('Activities'),
        'parent' => ('Parent Activity'),
        );

       $customPostArgs = array(
        'labels' => $this->labels,
        'hierarchical' => true,
        'description' => 'Activities for language learners filterable by Student class',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments', 'revisions', 'page-attributes'),
        'taxonomies' => array('classes','activities'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-playlist-audio',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'activities'),
        'capability_type' => 'post',
        'has_archive' => 'true',
        );

       register_post_type('atel_activities', $customPostArgs);
   }

   /**
    * [selectCoverImageMetaBox description]
    * @return [type] [description]
    */
   public function selectCoverImageMetaBox()
   {

   }

   /**
    * [selectCoverImageMetaBox description]
    * @return [type] [description]
    */
   public function selectCoverSoundMetaBox()
   {

   }

   /**
    * We need to reassign the first posted image to be the featured image.
    * @return null
    */
   public function reassignFeaturedImage()
   {

   }

   /**
    * Remove the "Add Featured Image" meta box in the new Activity page. We still need the post thumbnail capability under the hood.
    * @return [type] [description]
    */
   public function hideMetaBoxes()
   {
        // for some odd reason this doesn't work. Very annoying.
        remove_meta_box( 'postimagediv', 'atel_activities', 'normal' );
        remove_meta_box( 'handlediv', 'atel_activities', 'normal' );
   }


    /**
     * Defines an array of labels to pass to the
     * ref: https://codex.wordpress.org/Function_Reference/register_post_type.
    **/
    function buildCustomPostWidgets()
    {

        add_meta_box( 'cover_image_meta_box', 'Add a Cover Image', 'selectCoverImageMetaBox', 'atel_activities', 'normal', 'high' );
        add_meta_box( 'cover_sound_meta_box', 'Add a Cover Sound', 'selectCoverSoundMetaBox', 'atel_activities', 'normal', 'high' );
    }

    /**
     * Use the first image from the post as the 'featured' image.
     */
    function setFeaturedImage()
    {
        $post_id = get_the_id();
        $featuredImage = get_post_custom_values( 'no_featured_image', $post_id );
        if (empty($featuredImage[0]) ){

        }


    }



    /**
     * The 'register_post_type' function needs to be called during the WP init phase of execution.
     * note, when using this in a class based plugin we need to define the callback class "which is always $this" via an array.
     **/
    public function registerCustomPost()
    {
        add_action('init', array($this, 'buildCustomPost'));
        // add_action('admin_init', array($this, 'buildCustomPostWidgets'));
        add_action('admin_menu', array($this,'hideMetaBoxes' ));

        add_action('the_post', array($this, 'setFeaturedImage' ));
        add_action('save_post', array($this, 'setFeaturedImage' ));
        add_action('draft_to_publish', array($this, 'setFeaturedImage' ));

    }
}
