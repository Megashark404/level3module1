<?php 
$config = include 'config.php';
include 'classes/QueryBuilder.php';
include 'classes/Connection.php';
include 'classes/Validation.php';
include 'classes/FlashMessage.php';

FlashMessage::sessionStart();

$name = $_POST['name'];
$speciality = $_POST['speciality'];
$job = $_POST['job'];
$contact = $_POST['contact'];

//var_dump($_POST);die;

$pdo = Connection::make($config['database']);

$db = new QueryBuilder($pdo);

$validate = new Validation($pdo);

//var_dump($validate);die;
$validation = $validate->check($_POST, [
    'name' => [
        'required' => true,
        'min' => 2,
        'max' => 15,
        'unique' => 'persons'
    ],
    'speciality' => [
        'min' => 2,
        'max' => 30,
        'required' => true
    ],
    'job' => [
        'min' => 2,
        'max' => 50
    ],
    'contact' => 
    [
        'min' => 2,
        'max' => 30
    ]
]);

if ($validation->passed()) {
    $db->insert('persons', [
        'name' => $name,
        'speciality' => $speciality,
        'job' => $job,
        'contact' => $contact
    ]);

    FlashMessage::setMessage('success', 'Пользователь добавлен');
    header('location: /marlin/level3/');
}
else {
    //var_dump($validation->errors());
    foreach ($validation->errors() as $error) {
        //echo $error.'<br>';
        $errors .= $error.'<br>';
        
    }
    FlashMessage::setMessage('error', $errors);
    header('location: /marlin/level3/user/create');
}





 ?>