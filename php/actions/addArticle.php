<?php
require '../init.php';

header( 'Content-type: application/json' );

$response = array();

if ( isset( $_POST['article_game'] ) && isset( $_POST['article_title'] ) && isset( $_POST['article_content'] ) ) {

    $allowed_types = array( 'jpg', 'jpeg' );
    if ( !in_array( pathinfo( $_FILES['article_image']['name'], PATHINFO_EXTENSION ), $allowed_types ) ) {
        $response['status'] = 'error';
        $response['message'] = 'Error.. Invalid image type!';

    } else {
        if ( isset( $_FILES['article_image'] ) ) {
            if ( $_FILES['article_image']['size'] > 10485760 ) {
                //10 MB ( size is also in bytes )
                $response['status'] = 'error';
                $response['message'] = 'Image is too big!';

            } else {
                $uploads_dir = '../../img/uploads/articles/';
                $new_img_name = round( microtime( true ) * 1000 ).".".pathinfo( $_FILES['article_image']['name'], PATHINFO_EXTENSION );

                move_uploaded_file( $_FILES['article_image']['tmp_name'], $uploads_dir.$new_img_name );

                if ( file_exists( $uploads_dir.$new_img_name ) ) {
                    if ( $articleHndlr->articleExists( $db, array($_POST['article_title']) ) ) {
                        $response['status'] = 'error';
                        $response['message'] = 'Article already exist!';
                    } else {
                        if ( $articleHndlr->insertArticle( $db, array( $_POST['article_title'], $_POST['article_content']
                        , $new_img_name, $_POST['article_game'] ) ) ) {
                            $response['status'] = 'success';
                            $response['message'] = 'Great! Article successfully posted.';
                        } else {
                            $response['status'] = 'error';
                            $response['message'] = 'Error..Failed to post article!';
                        }
                    }
                }
            }
        }
    }

}

echo json_encode( $response );
$db->disconnect();
?>