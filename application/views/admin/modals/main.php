<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 28.10.12
 * Time: 13:54
 * To change this template use File | Settings | File Templates.
 */
define('WEBROOT',trim(dirname($_SERVER['PHP_SELF']),'/'));
?>
<html>
<head>
    <title>Панель управления UniqBox</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!-- Main stylesheed  (EDIT THIS ONE) -->
    <link rel="stylesheet" href="/media/admin/css/style.css" />
    <link rel="stylesheet" href="/media/admin/css/jquery.tooltip.css" />

    <!-- jQuery AND jQueryUI -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

    <!-- jQuery Cookie - https://github.com/carhartl/jquery-cookie -->
    <script type="text/javascript" src="/media/admin/js/cookie/jquery.cookie.js"></script>

    <!-- jWysiwyg - https://github.com/akzhan/jwysiwyg/ -->
    <link rel="stylesheet" href="/media/admin/js/jwysiwyg/jquery.wysiwyg.old-school.css" />
    <script type="text/javascript" src="/media/admin/js/jwysiwyg/jquery.wysiwyg.js"></script>


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
<body class="modal white">
<!--
      CONTENT
                -->
<div id="content" class="white">
    <div class="bloc">
        <div class="title">
            <?=$page_name?>
        </div>
        <div class="content">
            <?
            if (isset($content))
                echo $content;
            ?>
        </div>
    </div>
</div>


</body>
</html>
