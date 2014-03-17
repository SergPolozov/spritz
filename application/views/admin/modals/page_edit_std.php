<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 30.10.12
 * Time: 9:20
 * To change this template use File | Settings | File Templates.
 */
?>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="el_id" value="<? if (isset($obj->id)){ echo $obj->id;}?>" />
    <input type="hidden" name="save" value="1" />

    <? if(isset($_REQUEST['get_type']))
      {
	  echo '<input type="hidden" name="type" value="'.$_REQUEST['get_type'].'" />';
      }

    ?>

    <div class="input">
        <label for="name">Название </label>
        <input type="text" id="name" name="name" value="<? if (isset($obj->name)){ echo $obj->name;}?>" x-webkit-speech="" speech="" lang="ru-RU" data-ovi-hasaddedvoiceinputfeature="true"/>
    </div>
    <div class="input textarea">
        <label for="content">Краткое описание</label>
        <textarea name="content" id="content" rows="14"><? if (isset($obj)){ echo $obj->content;}?></textarea>
    </div>
    <div class="input">
        <label for="url">Адрес в интернете (только латиница, пример: "ginekologia")</label>
        <input type="text" id="url" name="url" value="<? if (isset($obj->url)){ echo $obj->url;}else{ echo 'page_'.$new_url; }?>" />
    </div>

    <div class="submit right" align="right">
        <input type="submit" value="сохранить" />
    </div>
    <div class="cb"></div>
</form>