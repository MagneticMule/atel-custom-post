<?php

class AtelCustomPostManager {

  public function __construct()
  {}

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
    public function setFeaturedImage()
    {
      $post_id = get_the_id();
      $featuredImage = get_post_custom_values( 'no_featured_image', $post_id );
      if (empty($featuredImage[0]) ){

      }
    }


    public function registerCustomPost()
    {
      add_action('admin_menu', array($this,'hideMetaBoxes' ));
      add_action('admin_init', array($this, 'buildCustomPostWidgets'));
      add_action('the_post', array($this, 'setFeaturedImage' ));
      add_action('save_post', array($this, 'setFeaturedImage' ));
      add_action('draft_to_publish', array($this, 'setFeaturedImage' ));
    }


  }