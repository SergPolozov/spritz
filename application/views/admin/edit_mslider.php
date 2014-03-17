<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 30.10.12
 * Time: 4:07
 * To change this template use File | Settings | File Templates.
 */
?>
<a href="/uniqbox/modal/slide_edit/" class="zoombox w600 h800"><img src="/media/admin/images/icons/button-add.png" border="0" /> ДОБАВИТЬ ЭЛЕМЕНТ</a>
<div class="cb"></div>
<div class="bloc">
    <div class="title">Список сайдеров</div>
    <div class="content">
        <table>
            <thead>
            <tr>
                <th style="width: 50px;">Название</th>
                <th style="width: 150px;">Описание</th>
                <th style="width: 150px;">Картинка</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?
            foreach ($sliders as $slide){
                ?>
            <tr>
                <td style="padding: 0 20px;"><?=$slide->name?></td>
                <td style="padding: 0 20px;"><?=$slide->descr?></td>
                <td style="padding: 0 20px;"><img src="/media/userfiles/images/<?=$slide->photo?>" border="0" width="200" /></td>
                <td style="padding: 0 20px;" class="actions">
                    <a title="Редактировать" class="zoombox w600 h800" href="/uniqbox/modal/slide_edit/?slide_id=<?=$slide->id?>"><img src="/media/admin/images/icons/actions/edit.png" /></a>
                    <a title="Удалить" class="ajax" answer="Элемент успешно удален" action="/uniqbox/editpage/mslider/" href="/uniqbox/modal/slide_edit/?del=1&slide_id=<?=$slide->id?>"><img src="/media/admin/images/icons/actions/delete.png" /></a>
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