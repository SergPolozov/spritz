<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 25.10.12
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */
?>
<script type="text/javascript" src="/media/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/media/ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#editpage').submit(function() {
            $('#pagecontent').val($('#pagecontent').val());
            $(this).ajaxSubmit();
            return false;
        });
        config = {};
        //config.contentsCss = '/media/css/style.css';
        config.height = '400px';
        config.bodyClass = 'entry';
        CKEDITOR.replace( 'pagecontent', config);
//        $('#pagecontent').ckeditor(config);

        $('#banner_form').ajaxForm(function(data){
            if (data == 1)
                alert ('Баннер успешно сохранен');
        });

    });
</script>
<form method="post" id="editpage" action="">
    <input type="hidden" name="savepage" value="1" />
    <input type="hidden" name="url" value="<?=$url?>" />
    <input type="hidden" name="page_id" value="<?=$page->id?>" />
    <div class="bloc">
        <div class="title">Редактирование страницы "<?=$page->name?>"</div>
        <div class="content">
            <textarea id="pagecontent" name="text"><?=$pagecontent?></textarea>
            <div class="cb"></div>
        </div>
    </div>
</form>

<?
$i = 0;
foreach ($modules as $mod){
    if ($mod->bitmask & $page->modules){
        ?>
    <div class="bloc<?if ($i % 2 == 0){?> left<?} else {?> right<?}?>">
        <div class="title">Модуль "<?=$mod->name?>"</div>
        <div class="content">
            Редактирование в соответствующем разделе
        </div>
    </div>
    <?
        $i++;
    }
}

?>