<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 13.12.12
 * Time: 14:45
 * To change this template use File | Settings | File Templates.
 */
$i=0;
foreach($list as $obj){
$i++;
    $imgs = array();
    if($obj->imgs!=''){
        $imgs= json_decode($obj->imgs,true);
    }
    $obj->contentsmall = str_replace ("&nbsp;", " ", $obj->contentsmall);
    $obj->name = str_replace (" ", "&nbsp;", $obj->name);
    ?>
<li class="all" <?if($i%3==0){?> class="last"<?}?>>

    <?
    if (isset($obj->price)){
        $cnt = 1000000;
        $pricetemp = $obj->price;
        $price = number_format($pricetemp, 0, ',', ' ');

    } else {
        $price = "не определено";
    }


    ?>

    <div class="left_float_image_block estate">
        <a  class="showHiddenGallery" href="<?=$obj->url?>" style="height:212px;">
            <img  id="<?=$obj->id?>" alt="" src="<? echo isset($imgs[0]["src"])?$imgs[0]["src"]:""; ?>">

            <?
            if (isset($obj->new) && $obj->new == 1){
                ?>

                <i class="best_offer">Новое предложение</i>
                <?
            }
            ?>
        </a>
    </div><!-- .left_float_image_block -->

    <div class="right_float_block">
        <div class="app_title">
	<span class="object-title-container" style="margin:0;">
        <a href="<?=$obj->url?>">
            <!--<? if ($obj->objtype == 0){?>Вилла<?} else {?>Апартаменты<?}?> --> <?=$obj->name;?>
        </a> (ref. <?=$obj->idobject?>) <span class="price"<?if ($price=="0" || $obj->show_price == 1){?> style="cursor: pointer; margin-left: 20px;" title="Цену можно узнать у менеджера"<?}?>><?if ($price!="0" && $obj->show_price == 0){
        echo $price;?> &euro;</span><?
        if(isset($obj->sale)&&$obj->sale==1) {
            if ($obj->arenda_period == 0){
                echo "/в неделю";
            }
            if ($obj->arenda_period == 1){
                echo "/в месяц";
            }
            if ($obj->arenda_period == 2){
                echo "/в год";
            }
        }
    } else {?>запрос</span><?}?>
        <span class="idesstate" id_esstate="<?=$obj->id?>"></span>
        <!--
        <span class="back"></span>
        -->

        <? if (isset($favoriteids) && in_array($obj->id, $favoriteids)){ ?>
        <span class="add_to_favor" style="display:none;">1</span>
        <!-- <span class="delfavorite_star" id_esstate="<?=$obj->id?>"><img src="/media/images/star_del_from_fav.png" alt="Удалить из избранного" title="Удалить из избранного" /></span>-->
        <? } else { ?>
        <!-- <span class="favorite_star" id_esstate="<?=$obj->id?>"><img alt="Добавить в избранное" title="Добавить в избранное" src="/media/images/star_add_to_fav.png" /></span>-->
        <span class="add_to_favor" style="display:none;">0</span>
        <? } ?>



        </span>
        <div class="idobj hide_it" style="margin:0 !important;">#<?=$obj->idobject?></div>
        </div><!-- .app_title -->

        <div class="info">

            <?
            if ($obj->objtype == 0)
                $p["type"] = "вилла";
            if ($obj->objtype == 1)
                $p["type"] = "апартаменты";
            if ($obj->objtype == 2)
                $p["type"] = "бизнес";
            if ($obj->objtype == 3)
                $p["type"] = "инвестиции";

            if ($obj->garage == 1)
                $p["parking"] = "да";
            if ($obj->garage == 0)
                $p["parking"] = "нет";

            if ($obj->seaview == 1)
                $p["seaview"] = "да";
            if ($obj->seaview == 0)
                $p["seaview"] = "нет";

            ?>

            <label class="first_set">Тип: <i class="w"><a href="#" class="filter"><?=$p["type"]?></a></i></label>

            <label class="first_set">Жилая площадь: <i class="m2"><?=$obj->area?> м<sup>2</sup></i></label>

            <label>Кол-во комнат: <i><? if($obj->room!=0) echo $obj->room;else echo '-'; ?></i></label>

            <label>Кол-во спален: <i><?=$obj->bedroom?></i></label>

            <label><?if($obj->areaplace!=0){?>Площадь террасы:<?}else {?><?}?> <i class="m2"><? if($obj->areaplace!=0){?><?=$obj->areaplace?> м<sup>2</sup><?}else{?><?}?></i></label>

            <label>Паркинг:<i> <a href="#" class="filter"><?=$p["parking"]?></a></i></label>

            <label>Вид на море: <i><a href="#" class="filter"><?=$p["seaview"]?></a></i></label>

            <label><img src="/media/images/point.png" alt="" class="point" /> <i class="w"><? if($obj->place!='') echo $obj->place;else echo '-'; ?></i></label>



            <? // strip_tags($obj->short_des, "<b>|<br>|<sup>|<p>|<div>|<strong>");?>
            <!--
        <a href="/objects/?id=<?=$obj->id?>">подробнее...</a><br /><br />
        -->
        </div>
        <br clear="all" />


        <div id="<?=$obj->id?>_picture" class="hiden">
            <?
            foreach($imgs as $element){?>
                <p align="center">
                    <a class="hidden-gallery" href="<?=$element["src"]?>" alt=""></a>
                </p>

                <?}?>
        </div>


    </div><!-- .right_float_block -->
</li>
<?if($i%3==0){?>
    <br clear="all" />
    <?}?>


    <?}?>