<?php
namespace App\Setup;

if ( ! class_exists( 'ManageAdminMenu' ) ) :
  class ManageAdminMenu
  {
    /**
     * Run
     *
     * @return void
     */
    public function run()
    {
      add_action( 'admin_menu', [$this, 'add_admin_menu'] );
      
    }

    /**
     * Add Admin Menu
     *
     * @return void
     */
    public function add_admin_menu()
    {
      add_menu_page(
        'WP Todo List',
        'WP Todo List',
        'manage_options',
        'wp-todo-list',
        [$this, 'render_menu_page'],
        'dashicons-edit',
        5
      );
    }

    /**
     * Render Menu Page
     *
     * @return void
     */
    public function render_menu_page()
    {
      echo "<div class='wrap'><h3>WP Todo List</h3></div>";
    }
  }
endif;