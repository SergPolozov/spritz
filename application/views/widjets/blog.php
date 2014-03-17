<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 12.11.12
 * Time: 16:10
 * To change this template use File | Settings | File Templates.
 */?>
<div id="block_with_content">
<div id="blog_block">
<?foreach($list as$element){?>
<div id="<?=$element['element']->url?>" class="blog_item">
    <img src="/media/images/<?=$element['element']->url?>.png" class="blogo_pic" alt=""><?=$element['element']->content?> <?=$element['element']->name ?> <span class="date"><? if(count($element['childs'])>0){echo
date("d.m.y",$element['childs'][0]["element"]->dateIn);}?></span></span>
    <p><? if(count($element['childs'])>0){echo
    $element['childs'][0]["element"]->content;}?></p>
     <a href="<?=$element['element']->url?>" class="more">читать всё &gt;&gt;</a></div>
    <?}?>
    </div>
    </div>