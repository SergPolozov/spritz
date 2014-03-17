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

<?if($page->parent==0){?>
<div class="bloc">
    <div class="title">Отображать в  главном меню:</div>
    <div class="content">


        <div class="left">

            <input id="page_onmenu" type="checkbox" class="iphone w_onmenu"  data-page_id="<?=$page->id?>" value="1"<? if ($page->on_menu==1){?> checked="checked" <?}?> />
        </div>

        <div class="cb"></div>
    </div>
</div>
<?}?>
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