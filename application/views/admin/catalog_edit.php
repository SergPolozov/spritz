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
        CKEDITOR.replace( 'smalltext', config);
//        $('#pagecontent').ckeditor(config);

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
        <div class="title">Настройки страницы "<?=$page->name?>"</div>
        <div class="content">
	      Если галочка установлена то страница будет каталогом<br>
	      <input class="iphone" type="checkbox" name="type_content" <?if($page->type_content == '1'){echo 'checked';}?> ><br><br>
        Если галочка установлена то будет показан на главной<br>
        <input class="iphone" type="checkbox" name="on_main" <?if($page->on_main == '1'){echo 'checked';}?> ><br><br>     
        Если галочка установлена то будет топовым товаром (если не каталог)<br>
        <input class="iphone" type="checkbox" name="on_top" <?if($page->on_top == '1'){echo 'checked';}?> ><br><br>    
        Все настройки вступают в силу после сохранения.
        <div class="cb"></div>
	</div>
    </div>

    <div class="bloc">
        <div class="title">Редактирование страницы "<?=$page->name?>"</div>
        <div class="content">
            <textarea id="pagecontent" name="text"><?=$page->content?></textarea>


            <div class="cb"></div>
        </div>
    </div>

    <div class="bloc">
        <div class="title">Редактирование краткого описания "<?=$page->name?>"</div>
        <div class="content">
            <textarea id="smalltext" name="smalltext"><?=$page->smalltext?></textarea>


            <div class="cb"></div>
        </div>
    </div>

    <div class="bloc">
        <div class="title">Артикул "<?=$page->name?>"</div>
        <div class="content">
            <input name="articul" value="<?=$page->articul?>" />
            <div class="cb"></div>
        </div>
    </div>

    <div class="bloc">
        <div class="title">Цена "<?=$page->name?>"</div>
        <div class="content">
	    Розничная цена<br>
            <input name="price_one" value="<?=$page->price_one?>" /><br><br>
            Оптовая цена<br>
	    <input name="price_opt" value="<?=$page->price_opt?>" />

	    <div class="cb"></div>
        </div>
    </div>

    <div class="bloc">
        <div class="title">Alt для дефолтной картинки "<?=$page->name?>"</div>
        <div class="content">
            <input name="alt_img" value="<?=$page->alt_img?>" />
            <div class="cb"></div>
        </div>
    </div>

    <div class="bloc">
        <div class="title">Дефолтная картинка "<?=$page->name?>"</div>
        <div class="content">
            <img src="<?=$page->img?>" />
            <label for="img">Картинка </label>
            <input type="file" name="img" id="img" />
            <div class="submit">
                <input type="submit" value="сохранить">
            </div>
            <div class="cb"></div>
        </div>
    </div>
</form>

<div class="bloc">
    <div class="title">Отображать на главной:</div>
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


?>
