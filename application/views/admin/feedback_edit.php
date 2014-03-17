<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 07.11.12
 * Time: 17:27
 * To change this template use File | Settings | File Templates.
 */?>
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
        config.contentsCss = '/media/css/style.css';
        config.height = '400px';
        config.bodyClass = 'entry';
        CKEDITOR.replace( 'pagecontent', config);

//        $('#pagecontent').ckeditor(config);
        $("#make_date_pick").datepicker();
        $('#banner_form').ajaxForm(function(data){
            if (data == 1)
                alert ('Баннер успешно сохранен');
        });


    });
</script>
<script>
    $(document).ready(function(){
        $('.w_onmenu').bind('change', function(){
            if ($(this).attr('checked') != undefined && $(this).attr('checked').length)
                checked = 1;
            else
                checked = 0;

            $.post('/ajax/page_on_menu/', {page_id:$(this).data('page_id'), checked:checked}, function(){

            });
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
            <textarea id="pagecontent" name="text"><?=$page->content?></textarea>

            <div class="cb"></div>
        </div>
    </div>
    
    <div class="bloc">
        <div class="title">E-mail добавления "<?=$page->name?>"</div>
        <div class="content">
            <input name="email" value="<?=$page->email?>" />

            <div class="cb"></div>
        </div>
    </div>
    
    <div class="bloc">
        <div class="title">Дата добавления"<?=$page->name?>"</div>
        <div class="content">
            <input id="make_date_pick" name="date" value="<?=date("m/d/Y",$page->timestamp)?>" />

            <div class="cb"></div>
        </div>
    </div>

    
</form>

<div class="bloc">
    <div class="title">Отображать на сайте:</div>
    <div class="content">


        <div class="left">

            <input id="page_onmenu" type="checkbox" class="iphone w_onmenu"  data-page_id="<?=$page->id?>" value="1"<? if ($page->on_menu==1){?> checked="checked" <?}?> />
        </div>

        <div class="cb"></div>
    </div>
</div>
 
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

