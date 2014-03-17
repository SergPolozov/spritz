<script>
$(document).ready(function() {

    $(document).on('click','.catalog_item_delete', function(){
    
	  if (confirm("Удалить элемент?")) {

	  } else {
	    return false;
	  }

    });

});
</script>

<?php

$cat_tp = Functions::get_catalogtype();

?>
<div class="cb"></div>
<div class="bloc">
    <div class="title"><?=$module->name?></div>
    <div class="content">
	  <form action="/ajax/catalog_type_add" method="post">
		Название<bt>
		<div class="input"><input type="text" name="name" value=""></div>
		Адрес каталога<br>
		<div class="input"><input type="text" name="url" value=""></div>
		<select name="parent">
		      <option value="0">Выбрать раздел</option>
<?php

if(isset($cat_tp[0]))
{
    foreach($cat_tp[0] as $value)
    {
	echo '<option value="'.$value->id.'">'.$value->name.'</option>';

    }

}
?>
		</select><br>
		(если не выбран раздел, то созданный будет основным)<br><br>
		<div class="submit"><input type="submit" value="Добавить"></div>
	  </form>
    </div>
</div>

<?php

if(isset($cat_tp[0]))
{
    foreach($cat_tp[0] as $value)
    {
	echo '<div class="cb"></div>
	      <div class="bloc">
		  <div class="title"><input class="save_razdel_input" style="padding:5px;border:1px solid #c0c0c0;"  data-id="'.$value->id.'" value="'.$value->name.'"> <!--<a class="catalog_item_delete" style="color:red;" href="/ajax/catalog_type_delete?id='.$value->id.'">удалить</a>--></div>
		  <div class="content">';

	if(isset($cat_tp[$value->id]))
	{

	    echo '<table>
			<thead>
			<tr>
			    <th style="width:300px;">Название</th>
			    <th>Действия</th>
			</tr>
			</thead>
			<tbody>';

	    foreach($cat_tp[$value->id] as $val)
	    {

		echo  '<tr>
			    <td><input class="save_razdel_input" style="padding:5px;border:1px solid #c0c0c0;" data-id="'.$val->id.'"  value="'.$val->name.'"></td>
			    <td><a class="catalog_item_delete" style="color:red;" href="/ajax/catalog_type_delete?id='.$val->id.'">удалить</a></td>
			</tr>';

	    }

	    echo '</tbody>
		  </table>';

	}

	echo	  '</div>
	      </div>
	      <div class="cb"></div>';

    }

}
?>


