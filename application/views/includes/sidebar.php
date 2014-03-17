<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 23.10.12
 * Time: 12:50
 * To change this template use File | Settings | File Templates.
 */
?>
<!-- sidebar -->
<div class="grid_4 sidebar">

    <div id="categories-5" class="widget-container widget_nav_menu">
        <ul>
            <?
            if (isset($submenu)){
                foreach ($submenu as $sub){
                    ?>
                    <li<? if ($sub->url == $page){?> class="current-menu-item"<?}?>>
                        <a href="/uslugi/<?=$sub->url?>/"><span><?=$sub->name?></span></a>
                        <?
                        if (isset($page_second) && isset($catalog[$page_second->id]) && $sub->url == $page_second->url){
                            ?>
                            <ul>
                                <?
                                foreach ($catalog[$page_second->id] as $cat){
                                    ?>
                                    <li<?if (isset($page_third) && ($page_third->url == $cat->url)){?> class="current-menu-item"<?}?>><a href="/uslugi/<?=$sub->url?>/<?=$cat->url?>/"><?=$cat->name?></a></li>
                                    <?
                                }
                                ?>
                            </ul>
                            <?
                        }
                        ?>
                    </li>
                    <?
                }
            }
            ?>
        </ul>
    </div>

    <!--
    <div class="text-center">
        <img src="/media/userfiles/images/banner_right2.jpg" width="239" alt="" />
    </div>
    -->
    <a href="/ceny-skidki-i-varianty-oplaty/" class="button_link btn_pink insidebar"><span>прайс на услуги</span></a>
    <?
    foreach ($modules as $module){
        echo $module;
    }
    if (isset($page_third->id)){
        if (isset($page_third->doctors) && $page_third->doctors != ""){
            $docs = json_decode($page_third->doctors);
            foreach ($docs as $doc){
                $doc = Functions::doctorGet($doc);
                ?>
                <div align="center"><?=$doc->name?><br />
                    <img align="center" src="/media/userfiles/images/<?=$doc->photo?>" border="0" />
                    <br /><br />
                </div>
                <?
            }
        }
    } elseif (isset($page_second)){
        if (isset($page_second->doctors) && $page_second->doctors != ""){
            $docs = json_decode($page_second->doctors);
            foreach ($docs as $doc){
                $doc = Functions::doctorGet($doc);
                ?>
                <div align="center"><?=$doc->name?><br />
                    <img align="center" src="/media/userfiles/images/<?=$doc->photo?>" border="0" />
                    <br /><br />
                </div>
                <?
            }
        }
    }
    ?>


</div>
<!--/ sidebar -->
