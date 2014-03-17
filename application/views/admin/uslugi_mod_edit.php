<?php

function DrawRecursive_2($child,$url,$step=0){

    $content1 = '';

    $ids = array();

    foreach ($child as $obj){

	$nw = $obj["element"];
	
	if($nw->uparent == $step)
	{

	  $ids[] = $nw->id;

	  $content1 .= '<tr>
			    <td style="padding: 0 20px;">/'.$nw->url.'/</td>
			    <td style="padding: 0 20px;">'.$nw->name.'</td>
			    <td style="padding: 0 20px;" class="actions">
				<a title="Редактировать страницу (наполнение)" href="/uniqbox/editpage/'.$nw->id.'/"><img src="/media/admin/images/icons/comment-edit.png" width="19" /></a>
				<a title="Свойства (название, url)" class="zoombox w600 h800" href="/uniqbox/modal/new_for_module/'.$url.'/?el_id='.$nw->id.'"><img src="/media/admin/images/icons/actions/edit.png" /></a>
				<a title="Удалить" class="ajax" answer="Элемент успешно удален" action="/uniqbox/modules/'.$url.'/" href="/uniqbox/modal/delete_element/?el_id='.$nw->id.'"><img src="/media/admin/images/icons/actions/delete.png" /></a>
			    </td>
			</tr>';
	}
        //DrawRecursive($obj["childs"],$url,0);
    }

    return $content1;
}


function DrawRecursive($child,$url,$step=0){

    $content2 = '';
    $content1 = '';

    $ids = array();

    foreach ($child as $obj){
      
	$nw = $obj["element"];
	
	if($nw->uparent == 0)
	{
	  $ids[$nw->id] = $nw->name;

	  $content1 .= '<tr>
			    <td style="padding: 0 20px;">/'.$nw->url.'/</td>
			    <td style="padding: 0 20px;">'.$nw->name.'</td>
			    <td style="padding: 0 20px;" class="actions">
				<a title="Редактировать страницу (наполнение)" href="/uniqbox/editpage/'.$nw->id.'/"><img src="/media/admin/images/icons/comment-edit.png" width="19" /></a>
				<a title="Свойства (название, url)" class="zoombox w600 h800" href="/uniqbox/modal/new_for_module/'.$url.'/?el_id='.$nw->id.'"><img src="/media/admin/images/icons/actions/edit.png" /></a>
				<a title="Удалить" class="ajax" answer="Элемент успешно удален" action="/uniqbox/modules/'.$url.'/" href="/uniqbox/modal/delete_element/?el_id='.$nw->id.'"><img src="/media/admin/images/icons/actions/delete.png" /></a>
			    </td>
			</tr>';

	  $content2[$nw->id] = DrawRecursive_2($child,$url,$nw->id);

	}
        //DrawRecursive($obj["childs"],$url,0);
    }

	echo '<div class="bloc">
		<div class="title">Разделы</div>
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
			
			  '.$content1.'
			</tbody>
		    </table>
		</div>
	    </div><div class="cb"></div>';
    

	foreach($ids as $key=>$value)
	{
	    echo '<div class="bloc">
		    <div class="title">Раздел '.$value.'</div>
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
			    '.$content2[$key].'

			    </tbody>
			</table>
		    </div>
		</div><div class="cb"></div>';

	}

}

?>
<a href="/uniqbox/modal/new_for_module/<?=$module->url?>" class="zoombox w600 h800"><img src="/media/admin/images/icons/button-add.png" border="0" /> ДОБАВИТЬ ЕЛЕМЕНТ</a>
<div class="cb"></div>


            <?

                DrawRecursive($child,$module->url);

            ?>
 

<div class="cb"></div>