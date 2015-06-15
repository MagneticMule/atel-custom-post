<?php

class YoulistenRolesManager {

	public function __construct()
	{}

	public function youlistenChangeRoleNames()
	{
		global $wp_roles;
		if ( ! isset( $wp_roles )) {
			$wp_roles = new WP_Roles();
			$wp_roles->roles['editor']['name'] = 'Teacher';
			$wp_roles->role_names['editor'] = 'Teacher';
			$wp_roles->roles['subsciber']['name'] = 'Student';
			$wp_roles->role_names['subsciber'] = 'Student';
		}
	}

	public function registerRoleNames()
	{
		add_action('init', array($this, 'youlistenChangeRoleNames'));
	}

}