<?php
// files storage folder
$dir = '../sysfrm/uploads/pics/';

$_FILES['file']['type'] = strtolower($_FILES['file']['type']);

if ($_FILES['file']['type'] == 'image/png'
    || $_FILES['file']['type'] == 'image/jpg'
    || $_FILES['file']['type'] == 'image/gif'
    || $_FILES['file']['type'] == 'image/jpeg'
    || $_FILES['file']['type'] == 'image/pjpeg') {
    // setting file's mysterious name
    $filename = md5(date('YmdHis')) . '.jpg';
    $file = $dir . $filename;

    // copying
    copy($_FILES['file']['tmp_name'], $file);

    // displaying file
    $array = array(
        'filelink' => '/sysfrm/uploads/pics/' . $filename
    );

    echo stripslashes(json_encode($array));

}

