<?php

define('IMG_MAX_SIZE', '2000000');


/**
 * has_author_posts
 *
 * @param  mixed $id
 * @return bool
 */

function has_author_posts ($id) : bool {

$posts_query = get_author_posts($id);

if ($posts_query->have_posts()) {
  return true;
}
return false;

}

/**
 * get_author_posts
 *
 * @param  mixed $id
 * @return void
 */
function get_author_posts($id) {

  // Set the query arguments
  $args = array(
    'author' => $id,
    'post_type' => 'post',
    'posts_per_page' => -1,
    'post_status' => 'publish',
);

// Get the posts
return new WP_Query( $args );
}

/**
 * get_author_posts_id
 *
 * @param  mixed $id
 * @return int
 */
function get_author_posts_id($id) : int  {
$posts_query =  get_author_posts($id);
$array = [];

if ( $posts_query->have_posts() ) {
  // Loop through the posts
  while ( $posts_query->have_posts() ) {
    $posts_query->the_post();
	return get_the_ID();
  }
  // Reset the post data
wp_reset_postdata();
} else {
    return 0;
}
}

/* FUNCTIONS RELATED TO IMG UPLOAD
*
*
*
*
*/

/**
 * is_valid_image
 *
 * @param  mixed $name
 * @param  mixed $user_id
 * @return bool
 */
function is_valid_image(string $name, int $user_id) : bool {
    
    $uploads = $_FILES[$name];
	$upload_mimes = get_allowed_mime_types($user_id);
    
    // check if there re more than 20 images in the folder
    if (count(select_all_gallery_files()) >= 20) {
        return false;
    }
    //cant put more thn 10 images
    if (count($uploads['name']) > 10) {
        return false;
    }
    // check mimes
	foreach($uploads['name'] as $k => $v) {
		$check = wp_check_filetype($v, $upload_mimes);
        if ($check['type'] === false) {
            return false;
        }

	}
	foreach($uploads['size'] as $k => $v) {
	if ($v > IMG_MAX_SIZE) {
			return false;
		}
    }
	return true;
}

/**
 * get_upload_error_msg
 *
 * @param  mixed $name
 * @return string
 */
function get_upload_error_msg(string $name) : string
{
	$error = null;
	$uploads = $_FILES[$name];
	$upload_mimes = get_allowed_mime_types($user_id);
	
    if (count(select_all_gallery_files()) >= 20) {
        $error = 'Limite atteinte ! veuillez vider votre galerie !';
    }
	if (count($uploads['name']) > 10) {
		$error = 'Attention, vous ne pouvez pas sauvegarder plus de 10 images à la fois !';
	}
	foreach($uploads['name'] as $k => $v) {
		$check = wp_check_filetype($v, $upload_mimes);
		if ($check['type'] === false) {
			$error = '	Vous n\'avez pas enregistré d\'images ou le format de vos images n\'est pas valide (formats acceptés : jpeg, jpg, png ou bmp)';
		}
	}
	foreach($uploads['size'] as $k => $v) {
		if ($v > IMG_MAX_SIZE) {
			$error = 'Le fichier : ' . $uploads['name'][$k] . ' est trop volumineux';
		}
	}
	return $error;
}

/**
 * write_user_gallery_folder
 *
 * @return string
 */
function write_user_gallery_folder() : string
{
	// Return a path to a user's folder
	$user = wp_get_current_user();
	$target = WP_CONTENT_DIR . "/themes/Divi-child/user_uploads/" . $user->user_login . '/';
	return $target;
}

/**
 * select_all_gallery_files
 *
 * @param  mixed $folder_path
 * @return array
 */
function select_all_gallery_files(string $folder_path = '') : array
{
    // Define the folder path
    if ($folder_path === '') {
        $folder_path = write_user_gallery_folder();
    }
    $file_paths = glob( $folder_path . '*' );
    return $file_paths;
}

/**
 * delete_user_gallery_content
 *
 * @return void
 */
function delete_user_gallery_content()
{

    $file_paths = select_all_gallery_files();
    
    // Loop through each file and delete it
    foreach ( $file_paths as $file_path ) {
        if ( is_file( $file_path ) ) {
            unlink( $file_path );
        }
        else {
            return;
        }
    }
}

/**
 * delete_user_gallery_folder
 *
 * @return void
 */
function delete_user_gallery_folder()
{
    $folder_path = write_user_gallery_folder();
    
    // Check if there is no files inside
    if (empty(glob( $folder_path . '*' ))) {
    rmdir( $folder_path );
    } else {
        select_all_gallery_files();
        rmdir( $folder_path );
    }
    return;
}

/**
 * upload_image_gallery
 *
 * @param  mixed $user_id
 * @param  mixed $post_id
 * @param  mixed $name
 * @return void
 */
function upload_image_gallery(int $user_id, int $post_id, string $name) 
{
    
    // Check if post ID is valid
	if ($post_id > 0 && is_valid_image($name, $user_id)) {
            
            // Make the right folder path for user, then create folder
			$target = write_user_gallery_folder();
			wp_mkdir_p($target);
			
			$user = wp_get_current_user();
			// Get multiple uploaded files
			$uploads = $_FILES[$name];
	        foreach ($uploads['name'] as $i => $n) {
            // Check if file was uploaded successfully

            if ($uploads['error'][$i] === UPLOAD_ERR_OK) {
                // Generate a unique filename
                $filename = uniqid() . '_' . $n;
                // Move file to uploads directory
                move_uploaded_file($uploads['tmp_name'][$i], 'wp-content/themes/Divi-child/user_uploads/' . $user->user_login . '/' . $filename);
            }   else {
		echo '<p class="alert alert-danger m-3">Une erreur est survenue, veuillez recharger la page</p>';
        	}
        }
	}
}

/**
 * insert_img_gallery
 *
 * @param  mixed $file
 * @return void
 */
function insert_img_gallery(string $file)
{
    // Define the folder path
    $folder_path = write_user_gallery_folder();

    // Get an array of file paths within the folder
    $file_paths = glob( $folder_path . '*' );
}

/**
 * get_all_gallery_images_src
 *
 * @param  mixed $user
 * @return array
 */
function get_all_gallery_images_src(string $user) : array
{
    
// Get the wp path and not the server path for the image folder
$cut_path = 33 + strlen(WP_CONTENT_DIR)  + strlen($user);
$folder_path =  WP_CONTENT_DIR . "/themes/Divi-child/user_uploads/" . $user . '/';
$file_paths = glob( $folder_path . '*' );
$src_array = [];
foreach ($file_paths as $k => $v) {
	$img_name = substr($v, $cut_path);
	$src_array[] = get_stylesheet_directory_uri() . "/user_uploads/" . $user . '/' . $img_name;
}
	return $src_array;
}

/**
 * is_gallery_img_landscape
 *
 * @param  mixed $file
 * @return bool
 */
function is_gallery_img_landscape(string $file) : bool
{
	$size = getimagesize($file);
	if ($size[0] > $size[1]) {
		return true;
	} else {
		return false;
	}
}


/* FUNCTIONS RELATED TO HTML GENERATOR */

/**
 * make_img_input
 *
 * @param  mixed $name
 * @param  mixed $user_id
 * @return string
 */
function make_img_input(string $name, int $user_id) : string
{

$valid_test = is_valid_image($name, $user_id);


if (!$valid_test) {
    $invalid = 'is-invalid';
    $error = get_upload_error_msg($name);
    
}
return <<<HTML
    <div class="input-group mb-3">
		<label class="input-group-text" for="inputGroupFile02">Sauvegarder mes images</label>
		<input type="file" class="form-control {$invalid}" id="inputGroupFile02" name="{$name}[]" multiple>
    	<div class="invalid-feedback mb-3">{$error}</div>
	</div>
	<p class="small mb-3">Important : Vous ne pouvez pas ajouter plus de 10 images à la fois. Chaque image ne peut pas dépasser la taille de 2mo.</p>

HTML;
}

/**
 * make_text_input
 *
 * @param  mixed $user_id
 * @param  mixed $post_id
 * @return string
 */
function make_text_input(int $user_id, int $post_id) : string
{
    $user_id = get_current_user_id();
    $post = get_post($post_id);
	if ( !empty($post) && $post->post_author == $user_id ) {

		$title = $post->post_title;
		$description = $post->post_content;
		$value = esc_attr($title);
		$value_2 = esc_textarea($description);
	} else {
	    $value = '';
	    $value_2 = '';
	}
    if(!has_author_posts($user_id)) {
        $ph1 = 'Entrez un titre à votre future galerie';
        $ph2 = 'Ajoutez une description (facultatif)';
    } else {
        $ph1 = '';
        $ph2 = 'Nouvelle description (facultatif)';
    }
    return <<<HTML
<input class="form-control mb-2" type="text" name="title" placeholder="{$ph1}" value="{$value}" required>
<textarea class="form-control mb-2" name="description" placeholder="{$ph2}">{$value_2}</textarea>
HTML;
}

