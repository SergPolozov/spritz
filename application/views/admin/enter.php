<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 30.10.12
 * Time: 10:34
 * To change this template use File | Settings | File Templates.
 */
?>
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
        Здравствуйте, <a href="#">Гость</a>
    </div>
    <div class="right">
    </div>
</div>


<!--
        SIDEBAR
                 -->
<div id="sidebar">
    <a href="#collapse" id="menucollapse">&#9664; Свернуть панель</a>

</div>




<!--
      CONTENT
                -->
<script>
    $(document).ready(function(){
        $('#enter_form').ajaxForm(function(data){
            if (data == '1'){
                alert ('Вы успешно авторизовались');
                document.location = '/uniqbox/';
            } else {
                alert ('Пара логин/пароль неверна');
            }
        });
    });
</script>

<div id="content" class="white">
    <br /><br />
    <form method="post" action="/ajax/login/" id="enter_form">
        <div class="bloc">
            <div class="title">Вход</div>
            <div class="content">
                <div class="input">
                    <label for="login">Логин</label>
                    <input type="text" id="login" name="login" value="" x-webkit-speech="" speech="" lang="ru-RU" data-ovi-hasaddedvoiceinputfeature="true"/>
                </div>
                <div class="input">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" value="" x-webkit-speech="" speech="" lang="ru-RU" data-ovi-hasaddedvoiceinputfeature="true"/>
                </div>
                <div class="submit">
                    <input type="submit" value="войти" />
                </div>
            </div>
        </div>
    </form>
</div>
</div>


</body>
</html>
