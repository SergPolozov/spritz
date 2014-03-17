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
    <input type="hidden" name="type" value="<? if (isset($module->type)){ echo $module->type;}?>" />
    <input type="hidden" name="save" value="1" />
    <div class="input">
        <label for="name">Название </label>
        <input type="text" id="name" name="name" value="<? if (isset($obj->name)){ echo $obj->name;}?>" x-webkit-speech="" speech="" lang="ru-RU" data-ovi-hasaddedvoiceinputfeature="true"/>
    </div>
    <div class="input">
        <label for="img">Картинка </label>
        <input type="file" name="img" id="img" />
    </div>
    <div class="submit right" align="right">
        <input type="submit" value="сохранить" />
    </div>
    <div class="cb"></div>
</form>