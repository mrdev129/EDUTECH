<?php

$uploadPath = "../assets/images/about/";

$allowed = ['image/jpeg','image/jpg'];

function uploadImage($file,$name){

global $uploadPath,$allowed;

if(isset($_FILES[$file]) && $_FILES[$file]['name']!=''){

$type = $_FILES[$file]['type'];

if(!in_array($type,$allowed)){
echo "Invalid file type";
exit;
}

$target = $uploadPath.$name;

if(file_exists($target)){
unlink($target);
}

move_uploaded_file($_FILES[$file]['tmp_name'],$target);

}

}

uploadImage("process_image1","process-1.png");
uploadImage("process_image2","process-2.png");
uploadImage("process_image3","process-3.png");

echo "success";

?>