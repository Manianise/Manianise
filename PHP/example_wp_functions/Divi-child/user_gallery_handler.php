<?php

// Handle form submission
	if ( isset( $_POST['create_post'] ) || isset( $_POST['edit_post'] ) ) {
    	if ( ! wp_verify_nonce( $_POST['_wpnonce'], isset( $_POST['create_post'] ) ? 'create_post' : 'edit_post_' . $post_id)) {
            wp_die( '<p class="alert alert-danger"> Alerte sécurité </p>' );
        }
		
        // Prepare post data
        $post_data = array(
            'post_title' => sanitize_text_field( $_POST['title'] ),
            'post_content' => sanitize_text_field( $_POST['description'] ),
            'post_author' => $user_id,
            'post_type' => 'post',
            'post_status' => 'publish',
        );
		
		if (isset( $_POST['post_id']) ) {
			$post_id = wp_update_post( $post_data );
			echo '<p class="alert alert-success m-5"> Votre galerie a bien été mise à jour ! Vous pouvez la visualiser en cliquant <a href="'. home_url() . '/?page_id=' . $post_id .'"> ici </a></p>';
			
			}   else {
         	// Create new post
			$post_id = wp_insert_post( $post_data );
			echo '<p class="alert alert-success m-5"> Votre galerie a bien été créée ! Vous pouvez la visualiser en cliquant <a href="'. home_url() . '/?page_id=' . $post_id .'"> ici </a></p>';
        	}
		if (isset($_FILES['uploads']) && is_valid_image('uploads', $user_id)) {
			upload_image_gallery($user_id, $post_id, 'uploads');
		}
	}
	if (isset($_POST['delete_post']) || isset($_POST['clear_post'])) {
		if(isset($_POST['delete_post'])) {
			wp_delete_post($post_id);
			delete_user_gallery_content();
			delete_user_gallery_folder();
			echo '<p class="alert alert-danger m-3"> Votre galerie a bien été supprimée ! </p>';
			return;
		} else {
			delete_user_gallery_content();
			echo '<p class="alert alert-success m-3"> Votre galerie a bien été vidée ! </p>';
			return;
		}
	}