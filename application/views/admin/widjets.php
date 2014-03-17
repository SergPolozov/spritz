<script>
    $(document).ready(function(){
        $('.w_module').bind('change', function(){
            if ($(this).attr('checked') != undefined && $(this).attr('checked').length)
                checked = 1;
            else
                checked = 0;

            $.post('/ajax/page_module/', {page_id:$(this).data('page_id'), checked:checked, bitmask: $(this).data('bitmask')}, function(){

            });
        });
    });
</script>

<?
foreach ($modules as $mod){
    ?>
<div class="left">
    <label for="w_<?=$mod->url?>"><?=$mod->name?></label>
    <input id="w_<?=$mod->url?>" type="checkbox" class="iphone w_module" data-bitmask="<?=$mod->bitmask?>" data-page_id="<?=$page->id?>" value="1"<? if ((int)$page->modules & (int)$mod->bitmask){?> checked="checked" <?}?> />
</div>

<?
}
?>
<div class="cb"></div>
