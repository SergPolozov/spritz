<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 30.10.12
 * Time: 9:20
 * To change this template use File | Settings | File Templates.
 */
?>
<form id="form_save" method="post" enctype="multipart/form-data">
    <input type="hidden" name="el_id" value="<? if (isset($obj->id)){ echo $obj->id;}?>" />
    <input type="hidden" name="type" value="<? if (isset($module->type)){ echo $module->type;}?>" />
    <input type="hidden" name="save" value="1" />
    
    <input id="go_edit" type="hidden" name="go_edit" value="0" />
    
    <div class="input">
        <label for="name">Название </label>
        <input type="text" id="name" name="name" value="<? if (isset($obj->name)){ echo $obj->name;}?>" x-webkit-speech="" speech="" lang="ru-RU" data-ovi-hasaddedvoiceinputfeature="true"/>
    </div>
    <div class="input textarea">
        <label for="content">Краткое описание</label>
        <textarea name="content" id="content" rows="14"><? if (isset($obj)){ echo $obj->content;}?></textarea>
    </div>
    
    <div class="input">
        <label for="url">Порядок в списке</label>
        <input type="text" id="order" name="order" value="<? if (isset($obj->order)){ echo $obj->order;}?>" />
    </div>
    
    <div class="input">
        <label for="url">Адрес в интернете (только латиница, пример: "ginekologia")</label>
        <input type="text" id="url" name="url" value="<? if (isset($obj->url)){ echo $obj->url;}else{ echo 'page_'.$new_url; }?>" />
    </div>
    <?if($module->recursive==1){?>
    <label for="parent">Родительский элемент</label>
    <select name="parent" id="parent">
        <option value="-<?=$module->bitmask?>"<? if (!isset($obj->parent) || $obj->parent == -$module->bitmask){?> selected<?}?>><b><?=$module->name?></b></option>
        <?
        foreach ($parents as $cat){
            ?>
            <option value="<?=$cat->id?>"<? if ((isset($obj->parent) && $cat->id == $obj->parent) || (isset($_REQUEST["facility_parent"]) && $_REQUEST["facility_parent"] == $cat->id)){?> selected<?}?>><?=$cat->name?></option>
            <?
        }
        ?>
    </select>

    <?}?>
   <br><br>
    <div class="submit" align="right">
    <? if (!isset($obj)){ ?>

         <input id="save_and_edit" type="submit" value="Сохранить и перейти к редактированию" /><br><br>
        <input id="submit" type="submit" value="Сохранить и создать новый" />
    <? }else{ ?>
        <input type="submit" value="Сохранить" />
    
    <?}?>
    </div>
    <div class="cb"></div>
</form>