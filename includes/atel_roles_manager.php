<?php

class atel_roles_manager {

	public function __construct()
	{}

	public function changeRoleNames()
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

}