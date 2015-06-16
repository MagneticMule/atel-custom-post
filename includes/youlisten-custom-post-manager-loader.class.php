<?php

class AtelCustomPostManager {

  /**
   * The array of screen names that the custom widgets will appear on.
   */
  public $screens;

  /**
   * Default constructor. Initialises any member variables and sets the screen type.
   * @$screens defaults to 'youlisten_activities' however
   */
  public function __construct($s = array('youlisten_activities'))
  {
    $this->screens = $s;
  }


  /**
    * Remove the "Add Featured Image" meta box in the new Activity page. We still need the post thumbnail capability under the hood.
    * @return [type] [description]
   */
  public function hideMetaBoxes()
  {

    remove_meta_box( 'pageparentdiv', 'youlisten_activities', 'side' );
    // for some odd reason this doesn't work. Very annoying.
    remove_meta_box( 'postimagediv', 'youlisten_activities', 'side' );
  }

  public function hideControlls() {
    remove_action( 'media_buttons', 'media_buttons');
  }


  /**
   * Defines an array of labels to pass to the
   * ref: https://codex.wordpress.org/Function_Reference/register_post_type.
  **/
  function buildCustomPostWidgets()
  {
    // add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
    add_meta_box( 'cover_image_meta_box', 'Add an Image', array($this,'selectImageMetaBox'), 'youlisten_activities', 'normal', 'high' );
    add_meta_box( 'cover_sound_meta_box', 'Add a Sound', array($this,'selectSoundMetaBox'), 'youlisten_activities', 'normal', 'high' );
  }


  /**
   * Use the first image from the post as the 'featured' image.
   */
  public function setFeaturedImage()
  {
    $post_id = get_the_id();
    $featuredImage = get_post_custom_values( 'no_featured_image', $post_id );
    if (empty($featuredImage[0]) ){

    }
  }



  /**
    *
    * @return [type] [description]
    */
  public function selectImageMetaBox( $post )
  {
    echo '<p>Select an image from the gallery or upload one of your own.</p>';
    echo '<p><button type="button">Add a New Image</button></p>';

    echo '<a title="Set featured image" href="http://youlisten.dev/wp-admin/media-upload.php?post_id=58&amp;type=image&amp;TB_iframe=1&amp;width=363&amp;height=780" id="set-post-thumbnail" class="thickbox">Set featured image</a>';
  }

 /**
  *
  * @return [type] [description]
  */
 public function selectSoundMetaBox( $post )
 {
  echo '<p>Select a sound from the gallery or upload one of your own.</p>';
  echo '<p><button type="button">Add a New Sound</button></p>';
}

 /**
  * We need to reassign the first posted image to be the featured image.
  * @return null
  */
 public function reassignFeaturedImage()
 {

 }

  /**
   * Entry point for the class.
   * @return none
   */
  public function registerCustomPost()
  {
    add_action('do_meta_boxes', array($this,'hideMetaBoxes' ));
    add_action('admin_head', array($this,'hideControlls' ));
    add_action('admin_init', array($this, 'buildCustomPostWidgets'));
    add_action('the_post', array($this, 'setFeaturedImage' ));
    add_action('save_post', array($this, 'setFeaturedImage' ));
    add_action('draft_to_publish', array($this, 'setFeaturedImage' ));
  }


}