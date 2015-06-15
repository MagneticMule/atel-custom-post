<?php

/**
 * Plugin Name: Atel Custom Post.
 * Plugin URI: http://lsri.nottingham.ac.uk
 * Description: A post type designed for Atel
 * Version: 0.0.1
 * Author: Tom Sweeney
 * Author URI: http://www.magneticmule.com
 * License: GPL2.
 */

    /*  2015  Tom Sweeney  (email : skywriter@gmail.com)

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as
        published by the Free Software Foundation.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */

        // This file is part of a Wordpress plugin so don't call it directly
        defined('ABSPATH') or die('This plugin cannot be accessed directly you silly goose!');

        // imports
        require_once plugin_dir_path(__FILE__).'includes/youlisten-custom-post-manager-loader.class.php';
        require_once plugin_dir_path(__FILE__).'includes/youlisten-custom-post-manager.class.php';
        require_once plugin_dir_path(__FILE__).'includes/youlisten-custom-roles.class.php';
        require_once plugin_dir_path(__FILE__).'includes/youlisten-menu-customizer.class.php';

        function runAtelPost()
        {
            $youlistenRolesManager = new YoulistenRolesManager();
            $youlistenRolesManager->registerRoleNames();

            $atelPostManager = new AtelPostManager();
            $atelPostManager->registerPostManager();

            $atelCustomPostManager = new AtelCustomPostManager();
            $atelCustomPostManager->registerCustomPost();

            $youlistenMenuCustomizer = new YoulistenMenuCustomizer();
            $youlistenMenuCustomizer->modifyAdminMenu();
        }

        runAtelPost();

