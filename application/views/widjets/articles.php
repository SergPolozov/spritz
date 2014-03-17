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
            <h2 class="colHeader"><span>Статьи</span></h2>
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
	<b>

	</b>
    <div class="zoom">

		<?php
		    $img = '/media/images/default_goods_image.gif';

		    if($element['element']->img != '')
		    {
			  $img = $element['element']->img;
		    }

		    
		?>

		<img style="margin-right:10px;border-radius:9px;float:left;max-width:85px;max-height:85px;" src="<?=$img?>">

		<em><?=date("d.m.Y",$element['element']->timestamp); ?></em><br>

		<?=$element['element']->smalltext;?>

		<br>
		<span>
        	<a href="/<?=$element['element']->url;?>">читать далее...</a>
		</span>
		
		<div class="clear"></div>
    </div><br><br>
</li>
    <?}?>
            </ul>
            <!--<div class="wrapper"><a class="link2" href="/news/"><em><b>Все новости</b></em></a></div>-->
        </div>
    </div>

</div>
