<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 12.11.12
 * Time: 15:33
 * To change this template use File | Settings | File Templates.
 */?>
<div class="cb"></div>
<a href="/uniqbox/modal/new_for_parent/<?=$page->id?>?get_type=catalog" class="zoombox w600 h800"><img src="/media/admin/images/icons/button-add.png" border="0" /> ДОБАВИТЬ ЕЛЕМЕНТ</a>

<div class="bloc">
<?if(count($child)>0){?>
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
            <td style="padding: 0 20px;">/<?=$nw->url?>/</td>
            <td style="padding: 0 20px;"><?=$nw->name?></td>
            <td style="padding: 0 20px;" class="actions">
                <a title="Редактировать страницу (наполнение)" href="/uniqbox/editpage/<?=$nw->id?>/"><img src="/media/admin/images/icons/comment-edit.png" width="19" /></a>
                <a title="Свойства (название, url)" class="zoombox w600 h800" href="/uniqbox/modal/new_for_parent/<?=$page->id?>/?el_id=<?=$nw->id?>&get_type=catalog"><img src="/media/admin/images/icons/actions/edit.png" /></a>
                <a title="Удалить" class="ajax" answer="Элемент успешно удален" action="/uniqbox/editpage/<?=$page->id?>/" href="/uniqbox/modal/delete_element/?el_id=<?=$nw->id?>"><img src="/media/admin/images/icons/actions/delete.png" /></a>
            </td>
        </tr>
            <?
        }
        ?>
        </tbody>
    </table>
</div>

<?}?>
    </div>