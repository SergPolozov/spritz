<script>
    $(document).ready(function(){
        $('#meta_form').ajaxForm(function(){
            alert ('Успешно сохранено');
        });
    });
</script>
<form method="post" id="meta_form" action="/ajax/meta_save/">
    <input type="hidden" name="page_id" value="<?=$page->id?>" />
    <div class="input">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?=$page->meta_title?>" />
    </div>
    <div class="input">
        <label for="meta_key">Meta Keywords</label>
        <input type="text" name="meta_key" id="meta_key" value="<?=$page->meta_key?>" />
    </div>
    <div class="input">
        <label for="meta_descr">Meta Description</label>
        <input type="text" name="meta_descr" id="meta_descr" value="<?=$page->meta_descr?>" />
    </div>
    <div class="submit">
        <input type="submit" value="сохранить" />
    </div>

</form>