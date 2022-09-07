<?php
require '../init.php';

header( 'Content-type: application/json' );

$response = array();

if ( isset( $_POST['game_title'] ) && isset( $_POST['game_download_link'] ) && isset( $_POST['game_trailer_link'] ) ) {

    $allowed_types = array( 'jpg', 'jpeg' );
    if ( !in_array( pathinfo( $_FILES['game_image']['name'], PATHINFO_EXTENSION ), $allowed_types ) ) {
        $response['status'] = 'error';
        $response['message'] = 'Error.. Invalid image type!';

    } else {
        if ( isset( $_FILES['game_image'] ) )
        {
            if ( $_FILES['game_image']['size'] > 10485760 ) {
                //10 MB ( size is also in bytes )
                $response['status'] = 'error';
                $response['message'] = 'Image is too big!';

            } else {
                $uploads_dir = '../../img/uploads/games/';
                $new_img_name = round( microtime( true ) * 1000 ).".".pathinfo( $_FILES['game_image']['name'], PATHINFO_EXTENSION );

                move_uploaded_file( $_FILES['game_image']['tmp_name'], $uploads_dir.$new_img_name );
                if ( $gameHndlr->gameExists( $db, array( $_POST['game_title'] ) ) ) {
                    $response['status'] = 'error';
                    $response['message'] = 'Game already exist in databse!';
                } else {
                    if ( file_exists( $uploads_dir.$new_img_name ) ) {
                        if ( $gameHndlr->insertGame( $db, array( $_POST['game_title'], $_POST['game_download_link']
                        , $_POST['game_trailer_link'], $new_img_name ) ) ) {
                            if ( $forumHndlr->insertTopic( $db, array( 4, $_SESSION['id'], $_POST['game_title'], 'This is the Official topic of '.$_POST['game_title'].' (open discussion).' ) ) ) {
                                $response['status'] = 'success';
                                $response['message'] = 'Great! Game successfully registered.';

                            }
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