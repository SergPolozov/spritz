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
        //CKEDITOR.replace( 'pagecontent', config);
        //CKEDITOR.replace( 'smalltext', config);
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
        <div class="title">Редактирование страницы "<?=$page->name?>"</div>
	<div class="content">
	    <div class="input">
		Текст верхний<br>
		<input name="text1" value="<?=$page->text1?>"><br><br>

		Ссылка<br>
		<input name="link" value="<?=$page->link?>">

		<div class="cb"></div>
	    </div>
	</div>
    </div>

    <div class="bloc">
        <div class="title">Редактирование картинки "<?=$page->name?>"</div>
        <div class="content">
            <img width="300" src="<?=$page->img?>" />
            <label for="img">Картинка </label>
            <input type="file" name="img" id="img" />
            <div class="submit">
                <input type="submit" value="сохранить">
            </div>
            <div class="cb"></div>
        </div>
    </div>
</form>
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