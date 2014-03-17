<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 13.12.12
 * Time: 15:50
 * To change this template use File | Settings | File Templates.
 */?>

<?
if($user!=""){

    $array =array();
    if($user->data!=""){
       $array=  json_decode($user->data,true);
    }
    ?>
Имя<input  name="name" value="<?isset($array["name"])?$array["name"]:""?>" /><br/>
Фамилия<input  name="surname" value="<?isset($array["surname"])?$array["surname"]:""?>" /><br/>
Телефон<input  name="phone" value="<?isset($array["phone"])?$array["phone"]:""?>" /><br/>
<?
}else{
?>
Необходимо залогинится

<?
}
?>