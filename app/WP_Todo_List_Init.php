<?php

namespace App;

if ( ! class_exists('WP_Todo_List_Init') ) {
  final class WP_Todo_List_Init
  {

    const version = '1.0.0';

    private function __construct()
    {
      $this->define_constants();

      register_activation_hook( WP_TODO_LIST__FILE__, [ $this, 'activate' ]);
      register_deactivation_hook( WP_TODO_LIST__FILE__, [ $this, 'deactivate' ]);

      // add_action('admin_notices', [ $this, 'show_log' ]);
      add_action('plugins_loaded', [ $this, 'init_plugin' ]);
    }

    private function services()
    {
      return [
        Setup\ManageAdminMenu::class,
      ];
    }

    /**
     * Initialize the plugin
     *
     * @return App
     */
    public static function init()
    {
      static $instance = false;

      if (!$instance) {
        $instance = new self();
      }

      return $instance;
    }

    /**
     * Init Plugin
     */

    public function init_plugin()
    {
      $this->register_services();
    }

    /**
     * Register Services
     *
     * @return void
     */
    private function register_services()
    {
      $services = $this->services();

      if ( ! count( $services ) ) { return; }

      foreach ( $services as $service ) {
        if ( class_exists( $service ) ) {
          $service_class = new $service();

          if ( method_exists( $service, 'run' ) ) {
            $service_class->run();
          }
        }
        
      }
    }

    /**
     * Activate The Plugin
     *
     * @return void
     */
    public function activate()
    {
      flush_rewrite_rules();

      $installed = get_option( 'wp_todo_list_installed_on' );

      if ( ! $installed ) {
        update_option( 'wp_todo_list_installed_on', time() );
      }

      update_option( 'wp_todo_list_version', WP_TodoList_Version );
    }

    /**
     * Deactivate The Plugin
     *
     * @return void
     */
    public function deactivate()
    {
      flush_rewrite_rules();
    }

    /**
     * Define Constants
     *
     * @return void
     */
    private function define_constants()
    {
      define('WP_TodoList_Version', self::version);
    }

    /**
     * Show Log
     * @return void
     */

    public function show_log()
    {
      $version = get_option( 'wp_todo_list_version' );
      $installed_on = get_option( 'wp_todo_list_installed_on' );
      $text = '<p>WP_TodoList_Version installed_on : ' . $installed_on . '</p>';
      $text .= '<p>WP_TodoList_Version_opt : ' . $version . '</p>';
      
      
      $text .= '<p>WP_TodoList_Version : ' . WP_TodoList_Version . '</p>';
      $text .= '<p>WP_TODO_LIST__FILE__ : ' . WP_TODO_LIST__FILE__ . '</p>';
      $text .= '<p>WP_TODO_LIST_PLUGIN_BASE : ' . WP_TODO_LIST_PLUGIN_BASE . '</p>';
      $text .= '<p>WP_TODO_LIST_PATH : ' . WP_TODO_LIST_PATH . '</p>';
      $text .= '<p>WP_TODO_LIST_URL : ' . WP_TODO_LIST_URL . '</p>';
      $text .= '<p>WP_TODO_LIST_ADMIN_PATH : ' . WP_TODO_LIST_ADMIN_PATH . '</p>';
      $text .= '<p>WP_TODO_LIST_ADMIN_URL : ' . WP_TODO_LIST_ADMIN_URL . '</p>';
      $text .= '<p>WP_TODO_LIST_PUBLIC_PATH : ' . WP_TODO_LIST_PUBLIC_PATH . '</p>';
      $text .= '<p>WP_TODO_LIST_PUBLIC_URL : ' . WP_TODO_LIST_PUBLIC_URL . '</p>';

      echo "<div class='notice notice-warning is-dismissible'>$text</div>";
    }
  }
}
