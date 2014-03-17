<?php

$catalog = ORM::factory("settings")->find_all();

?>

<div class="cb"></div>

<?php



foreach($catalog as $value)
{
?>
<div class="bloc">
    <div class="title"><?=$value->name?></div>
    <div class="content">
        <form action="/ajax/save_settings">
	    <input type="hidden" value="<?=$value->id?>" name="id">
<?if($value->type == 1){
	    echo '<textarea style="padding:5px;border:1px solid #c0c0c0;width:300px;height:50px;" name="top_text">'.$value->text.'</textarea><br><br>';
}
else{
	    echo '<div class="input"><input name="top_text" value="'.$value->text.'"></div>';
}
?>
	    <div class="submit"><input type="submit" value="Сохранить"></div>
	</form>
    </div>
</div>
<?
}
?>


<div class="cb"></div>