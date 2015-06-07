<?php


class AtelPostManager {
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
    protected $tag = 'AtelPostManager';

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
     * Changes the names of the menu items for 'posts' to 'activities'.
     * This is useful as most of the users of this system will be non-native English speakers.
     * We can change the labels of objects to something more pedagogically relevant.
     * @return none
     */
    function atelChangePostLabel() {
        global $menu;
        global $submenu;
        $menu[5][0] = 'Activities';
        $submenu['edit.php'][5][0] = 'Show All Activities';
        $submenu['edit.php'][10][0] = 'Create a New Activity';
        $submenu['edit.php'][16][0] = 'Tags';
        $submenu['edit.php'][15][0] = 'Categories';
    }


    /**
     * Changes the labels from '* post' to '* activity'.
     * @return none
     */
    function atelChangePostObject() {
        global $wp_post_types;
        $labels = $wp_post_types['post']->labels;
        $labels->name = 'Activities';
        $labels->singular_name = 'Activity';
        $labels->add_new = 'Add a New Activity';
        $labels->add_new_item = 'Create a New Activity';
        $labels->edit_item = 'Edit an Activity';
        $labels->new_item = 'Activities';
        $labels->view_item = 'View Activities';
        $labels->search_items = 'Search Activities';
        $labels->not_found = 'No Activities found';
        $labels->not_found_in_trash = 'No Activities in the Trash';
        $labels->all_items = 'All Activities';
        $labels->menu_name = 'Activities';
        $labels->name_admin_bar = 'Activities';
    }


    /**
     * The 'register_post_type' function needs to be called during the WP init phase of execution.
     * note, when using this in a class based plugin we need to define the callback class "which is always $this" via an array.
     **/
    public function registerPostManager()
    {
        add_action('admin_menu', array($this, 'atelChangePostLabel'));
        add_action('init', array($this, 'atelChangePostObject'));
    }
}
