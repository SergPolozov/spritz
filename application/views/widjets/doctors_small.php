<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 28.10.12
 * Time: 13:00
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="divider_space"></div>

<h2>Наши специалисты:</h2>
<?
if (isset($doctors_marked)){
    foreach ($doctors_marked as $doc){
        ?>
    <img src="/media/userfiles/images/<?=$doc->photo?>" alt="" width="115" height="174" class="alignright" />
    <h3 class="title_pink text_italic"><?=$doc->name?></h3>
    <p>
        <?=str_replace("\n", "<br />", $doc->descr)?>
    </p>
    <div class="divider_space_thin"></div>
    <?
    }
}
?>

<a href="/nashi-doktora/" class="button_link"><span>Посмотреть всех специалистов</span></a>
