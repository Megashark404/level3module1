<?php 
$config = include 'config.php';
include 'classes/QueryBuilder.php';
include 'classes/Connection.php';

$id = $_GET['id'];

$pdo = Connection::make($config['database']);
$db = new QueryBuilder($pdo);

$db->delete('persons', $id);

header('location: /marlin/level3/');


//var_dump($config['database']);die;





/*
if (email_is_not_available($email)) {
    set_flash_message('danger', 'Такой email уже существует');
    redirect_to('page_create_user.php');
 
}
else {
    //var_dump($_POST); die;
    $user_id = add_user($email, $password);
    edit_user_information($user_id, $username, $job, $phone, $address);
    set_status($user_id, $status);        
    add_social_links($user_id, $vk, $telegram, $instagram);

    $image = upload_image($_FILES);
    set_avatar($user_id, $image);

    set_flash_message('success', 'Пользователь добавлен');
    redirect_to('users.php');
}

*/


 ?>