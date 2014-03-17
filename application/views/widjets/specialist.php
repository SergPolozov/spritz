<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 12.12.12
 * Time: 16:23
 * To change this template use File | Settings | File Templates.
 */?>


<div id="alert_doctor">

</div>

<div class="indent">
    <div class="box2">
        <div class="inner">
            <h2 class="colHeader"><span>Специалисты</span></h2>
            <div align="center">
                <? foreach ($list as $element){
                    $doctor = $element['element'];
                    break;
                }
                ?>
                <h2 class="colHeader"><span><?=$doctor->name?></span></h2>

                <?php
                $img = '/media/images/default_goods_image.gif';

                if($doctor->img != '')
                {
                    $img = $doctor->img;
                }


                ?>
                <img style="width: 400px;" src="<?=$img?>" />
                <br /><br />
                <div style="text-align: justify;">
                    <?=$doctor->content?>
                </div>

                <div class="clear"></div>

            </div>
            <!--
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
                    <li class="spec_on_page">
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

                            <div style="float:left;width:180px;height:150px;">
                                <img style="margin-right:10px;border-radius:9px;float:left;max-width:150px;max-height:150px;" src="<?=$img?>">
                            </div>

                            <div style="float:left;width:200px;height:200px;">

                                <div style="font-size:20px;margin-bottom:10px;"><a class="spec_show" href="#" data-id="<?=$element['element']->id;?>"><?=$element['element']->name;?></a></div>

                                <?=$element['element']->smalltext;?>

                                <div id="full_info_<?=$element['element']->id;?>" style="display:none;">
                                    <img class="close_alert" style="position:absolute;right:10px;top:10px;cursor:pointer;" src="/media/images/close.png">
                                    <div style="float:left;width:110px;height:100px;">
                                        <img style="margin-right:10px;border-radius:9px;float:left;max-width:100px;max-height:100px;" src="<?=$img?>">
                                    </div>
                                    <div style="float:left;width:390px;height:100px;font-size:20px;"><?=$element['element']->name;?></div>
                                    <div class="clear"></div>
                                    <br>
                                    <hr>
                                    <br>
                                    <?=$element['element']->content;?>
                                </div>
                            </div>


                            <div class="clear"></div>
                        </div><br><br>
                    </li>
                <?}?>
            </ul>
            -->
            <div class="clear"></div>
            <!--<div class="wrapper"><a class="link2" href="/news/"><em><b>Все новости</b></em></a></div>-->
        </div>
    </div>

</div>
