<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 25.10.12
 * Time: 9:15
 * To change this template use File | Settings | File Templates.
 */
define('WEBROOT',trim(dirname($_SERVER['PHP_SELF']),'/'));
?><!DOCTYPE html>
<html>
<head>
    <title>Панель управления UniqBox</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <?php
    /**
     * NOT MINIFIED
     **
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.old-school.css" />

    <!-- jQuery AND jQueryUI -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/min.js"></script>
     */
    ?>


    <!-- Main stylesheed  (EDIT THIS ONE) -->
    <link rel="stylesheet" href="/media/admin/css/style.css" />
    <link rel="stylesheet" href="/media/admin/css/jquery.tooltip.css" />

    <!-- jQuery AND jQueryUI -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

    <!-- jQuery Cookie - https://github.com/carhartl/jquery-cookie -->
    <script type="text/javascript" src="/media/admin/js/cookie/jquery.cookie.js"></script>

    <script type="text/javascript" src="/media/admin/js/postplugin.js"></script>
    <!-- jWysiwyg - https://github.com/akzhan/jwysiwyg/ -->


    <!-- Tooltipsy - http://tooltipsy.com/ -->
    <script type="text/javascript" src="/media/admin/js/jquery.tooltip.js"></script>

    <!-- iPhone checkboxes - http://awardwinningfjords.com/2009/06/16/iphone-style-checkboxes.html -->
    <script type="text/javascript" src="/media/admin/js/iphone-style-checkboxes.js"></script>
    <script type="text/javascript" src="/media/admin/js/excanvas.js"></script>

    <!-- Load zoombox (lightbox effect) - http://www.grafikart.fr/zoombox -->
    <script type="text/javascript" src="/media/admin/js/zoombox/zoombox.js"></script>
    <script type="text/javascript" src="/media/admin/js/ajax_bind.js"></script>

    <!-- Charts - http://www.filamentgroup.com/lab/update_to_jquery_visualize_accessible_charts_with_html5_from_designing_with/ -->
    <script type="text/javascript" src="/media/admin/js/visualize.jQuery.js"></script>

    <!-- Uniform - http://uniformjs.com/ -->
    <script type="text/javascript" src="/media/admin/js/jquery.uniform.js"></script>
    <script type="text/javascript" src="/media/js/jquery.form.js"></script>


    <!-- Main Javascript that do the magic part (EDIT THIS ONE) -->
    <script type="text/javascript" src="/media/admin/js/main.js"></script>
     <script type="text/javascript" >
         var url="<?=$url?>"

     </script>
    <?php
    /***/
    ?>
</head>
<body>

<?php
/**
 * Do not use this content for production, this is done for demo purpose (it adds javascript settings pannel
 */
if (isset($settings))
    echo $settings;
?>

<!--
        HEAD
                -->
<div id="head">
    <div class="left">
        <a href="#" class="button profile"><img src="/media/admin/images/icons/top/huser.png" alt="" /></a>
        Здравствуйте,
        <a href="javascript: void(0);">Администратор</a>
        |
        <a class="ajax" href="/ajax/logout/">Выйти</a>
    </div>
    <div class="right">
        <!--
        <form action="#" id="search" class="search placeholder">
            <label>Looking for something ?</label>
            <input type="text" value="" name="q" class="text"/>
            <input type="submit" value="rechercher" class="submit"/>
        </form>
        -->
    </div>
</div>


<!--
        SIDEBAR
                 -->
<div id="sidebar">
    <ul>
        <li class="current hover"><a href="/uniqbox/modules/mainmenu"><img src="/media/admin/images/icons/menu/layout.png" alt="" />Главное меню</a>
            <ul>
                <?
                foreach($pages as $page){
                    ?>
                    <li<? if(isset($page_cur) && $page->id == $page_cur->id){?> class="current"<?}?>><a href="/uniqbox/editpage/<?=$page->id?>/" title="<?=$page->name?>"><?=$page->name?></a></li>
                    <?
                }
                ?>
            </ul>
        </li>
        <?foreach($modules as $element){?>
        <li><a href="/uniqbox/modules/<?=$element->url?>/"><img src="<?=$element->src?>" alt="" /><?=$element->name?></a>
        </li>

        <?}?>
        <li><a href="/uniqbox/render_all/"><img src="/media/admin/images/icons/menu/settings.png" alt="" />Выложить сайт</a>
        </li>

    </ul>
    <a href="#collapse" id="menucollapse">&#9664; Свернуть панель</a>

</div>




<!--
      CONTENT
                -->
<div id="content" class="white">
    <?
    if (isset($page_cur)){
        ?>
        <h1>Редактирование страницы "<?=$page_cur->name?>"</h1>
        
        <?if(isset($child)){ echo $child;}?>
        <div class="cb"></div>
        
        <?
        if (isset($content))
            echo $content;
        ?>

        <div class="cb"></div>
        <div class="bloc left">
            <div class="title">Мета-данные</div>
            <div class="content">
                <?
                if (isset($metas)){
                    echo $metas;
                }
                ?>
            </div>
        </div>
        <?
        if (!isset($nomodule)){

            ?>
            <div class="bloc right">
                <div class="title">Используемые модули</div>
                <div class="content">
                    <?
                    if (isset($widjets)){
                        echo $widjets;
                    }
                    ?>
                </div>
            </div>
            <?
        }
        ?>
        <?//if(isset($child)){ echo $child;}?>
        <div class="cb"></div>
        <?
    }
    ?>
    <?if(isset($modules_cur)){?>
    <h1>"<?=$modules_cur->name?>"</h1>
    <?
    if (isset($content))
        echo $content;
    ?>

    <?}?>
    <?if(isset($title)){?>
    <h1>"<?=$title?>"</h1>
    <div class="bloc">

        <div class="content">
            <?
            if (isset($content))
                echo $content;
            ?>
            <div class="cb"></div>
        </div>
    </div>

    <?}?>
</div>


</body>
</html>
