<?php
/**
* Plugin Name: Vgs Event planner
* Plugin URI: www.vgs.com
* Description: Plugin for Event Mngmnt.
* Version: 1.0.0
* Author: Gaurav
* Author URI: http://vgs.com

*/


add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script', 10 );
function wpdocs_selectively_enqueue_admin_script() {
    wp_enqueue_style( 'admin-my_custom_script', plugin_dir_url( __FILE__ ).'/css/style.css' );
}


add_action ('admin_menu' , 'event_menu');

function event_menu(){
add_menu_page( 'Event', 'Events', 'manage_options', 'event', 'test_init' );
//add_submenu_page('All Event', 'Custom', 'manage_options','test-plugin', 'clivern_render_custom_page');
add_submenu_page( 'event', 'Add Event', 'Add Events', 'manage_options', 'add-members-slug', 'add_members_function');
}


function test_init()
{
	echo "<h1>Welcome</h1>";

	include('includes/events-list.php');
}

function add_members_function()
{
	echo "<h1>Enter Event Detail:</h1>";
	include('includes/add-event.php');
}

add_action('init', 'insert_plugin_data');
function insert_plugin_data(){

     global $wpdb;
        $add_event = $wpdb->prefix.'add_event';
        $tbl1 = "CREATE TABLE IF NOT EXISTS $add_event ( 
            id int(11) NOT NULL auto_increment,
            user_id int(11) default NULL,
            event_name varchar(255) NOT NULL, 
            event_organizer varchar(255) NOT NULL,
            event_date date(dd-mm-yy) NOT NULL, 
            number_people int(11) NOT NULL,
            event_description varchar(255) NOT NULL, 
            event_status varchar(255) NOT NULL, 

            PRIMARY KEY (id)
            );";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $tbl1);

        update_option('attr_table_updated','attr_table_done_updated');


}

add_action('init','themename_add_new_event');
function themename_add_new_event() {
  $user_id = get_current_user_id();

      if ( isset( $_POST['event_submit'] ) ){
      
      $event_name   = $_POST['fname'];   
      $event_organizer  = $_POST['oname'];
      $event_date=$_POST['edate'];
      $number_people  = $_POST['people'];
      $event_description  = $_POST['desc'];
      $event_status  = $_POST['Status'];

      global $wpdb; 
      $tbl1 = $wpdb->prefix . "add_event"; 

      $wpdb->insert($tbl1, array(
                                'user_id' => $user_id,
                                'event_name' => $event_name, 
                                'event_organizer' => $event_organizer,
                                'event_date' => $event_date, 
                                'number_people' => $number_people, 
                                'event_description' => $event_description, 
                                'event_status' => $event_status, 
                                ),array(
                                '%s',
                                '%s','%s','%s','%s','%s','%s')
        );
      }
    }
    



?>

