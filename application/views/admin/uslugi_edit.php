
<script type="text/javascript" src="/media/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/media/ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#editpage').submit(function() {
            $('#pagecontent').val($('#pagecontent').val());
            $('#pagecontent_small').val($('#pagecontent_small').val());

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
        <div class="title">Редактирование "<?=$page->name?>"</div>
        <div class="content">
            <textarea id="pagecontent" name="text"><?=$page->content?></textarea>

            <div class="cb"></div>
        </div>
    </div>
    <div class="bloc">
        <div class="title">Цена</div>
        <div class="content">
            <input name="price" value="<?=$page->price?>">

            <div class="cb"></div>
        </div>
    </div>
    <div class="bloc">
        <div class="title">Родительский каталог</div>
        <div class="content">
            <select id="parent" name="uparent">
		    <option value="0">Создать новый раздел</option>
<?

foreach ($uparent as $value){

    $selected = '';

    if($page->uparent == $value->id) $selected = 'selected';

    echo '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';

}

?>
	    </select>
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

