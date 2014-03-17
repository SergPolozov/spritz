<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 12.12.12
 * Time: 16:23
 * To change this template use File | Settings | File Templates.
 */?>

<div class="indent">
    <div class="box2">
        <div class="inner">
            <h2 class="colHeader"><span>Новости</span></h2>
            <ul class="list1">

<?
/*
echo "<pre>";
var_dump($list);
echo "</pre>";
exit;
*/
foreach($list as $element){


?>
    <li>
	<b><?=$element['element']->name;?></b><br>
    <em><? echo date("d.m.Y",$element['element']->timestamp); ?></em>
	
    <div class="zoom">
		<?=$element['element']->content;?>

    </div><br><br>
</li>
    <?}?>
            </ul>
            
        </div>
    </div>

</div>
