<?PHP 

$connection = mysqli_connect('localhost','root','','medicio');
// if($connection){
//     echo 'working';
// }else{
//     echo 'not working';

// }
$directoryName = 'uploads';

if (!is_dir($directoryName)) {
    mkdir($directoryName, 0755, true);
}

?>