<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 30.10.12
 * Time: 2:40
 * To change this template use File | Settings | File Templates.
 */
?>
<a href="/uniqbox/modal/new_for_module/<?=$module->url?>" class="zoombox w600 h800"><img src="/media/admin/images/icons/button-add.png" border="0" /> ДОБАВИТЬ ЕЛЕМЕНТ</a>
<div class="cb"></div>
<div class="bloc">
    <div class="title"><?=$module->name?></div>
    <div class="content">
        <table>
            <thead>
            <tr>
                <th style="width: 50px;">URL</th>
                <th style="width: 150px;">Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?
            foreach ($child as $nw){
                ?>
            <tr>
                <td style="padding: 0 20px;">/<?=$nw["element"]->url?>/</td>
                <td style="padding: 0 20px;"><?=$nw["element"]->name?></td>
                <td style="padding: 0 20px;" class="actions">
                    <a title="Редактировать страницу (наполнение)" href="/uniqbox/editpage/<?=$nw["element"]->id?>/"><img src="/media/admin/images/icons/comment-edit.png" width="19" /></a>
                    <a title="Свойства (название, url)" class="zoombox w600 h800" href="/uniqbox/modal/new_for_module/<?=$module->url?>/?el_id=<?=$nw["element"]->id?>"><img src="/media/admin/images/icons/actions/edit.png" /></a>
                    <a title="Удалить" class="ajax" answer="Элемент успешно удален" action="/uniqbox/modules/<?=$module->url?>/" href="/uniqbox/modal/delete_element/?el_id=<?=$nw["element"]->id?>"><img src="/media/admin/images/icons/actions/delete.png" /></a>
                </td>
            </tr>
                <?

            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="cb"></div>