<script>
$(document).ready(function() {

    $(document).on('click','#add_field', function(){
    
	  var html = '<div class="wrap_dop">Название поля: <input class="name_field" type="text" value=""> Текст: <input class="value_field" name="" type="text" value=""></div><br><br>';

	  $('.wrap_dop_content').append(html);

	  return false;
    });
  
    $(document).on('keyup','.name_field', function(){
    
	  var val = 'data['+$(this).val()+']';
	  $(this).parents('.wrap_dop').find('.value_field').attr('name',val);

	  return false;
    });

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
$type_array = array('0'=>'Квартира','1'=>'Комната');

if(!isset($_REQUEST['id']) && !isset($_REQUEST['cat']))
{

?>
<script>
$(document).ready(function() {
    $('.toggle').trigger('click');
});
</script>

<div class="cb"></div>
<div class="bloc">
    <div class="title">Добавление</div>
    <div class="content">
	<form action="/ajax/catalog_item_add" method="post">

	  Тип
	  <select name="type">
<?php
    foreach($type_array as $key=>$value){
	  echo '<option value="'.$key.'">'.$value.'</option>';
    }
?>
	  </select><br>
	  Город, район, метро
	  <br>
	  <textarea name="city" style="width:300px;height:50px;"></textarea><br><br>
	  Адрес
	  <br>
	  <textarea name="address" style="width:300px;height:50px;"></textarea><br><br>

	  Тип дома
	  <br>
	  <div class="input"><input name="type_house" type="text" value=""></div><br>

	  Этаж / Кол-во этажей
	  <br>
	  <div class="input"><input name="floor" type="text" value=""></div><br>

	  Кол-во комнат
	  <br>
	  <div class="input"><input name="rooms" type="text" value=""></div><br><hr>

	  Площадь объекта (общая) метры
	  <br>
	  <div class="input"><input name="sq[0]" type="text" value=""></div><br>

	  Площадь объекта (жилая) метры
	  <br>
	  <div class="input"><input name="sq[1]" type="text" value=""></div><br>

	  Площадь объекта (кухня) метры
	  <br>
	  <div class="input"><input name="sq[2]" type="text" value=""></div><br><hr>

	  Стоимость руб.
	  <br>
	  <div class="input"><input name="price" type="text" value=""></div><br>

	  Статус дома (новостройка, и т.п.)
	  <br>
	  <div class="input"><input name="status_house" type="text" value=""></div><br>

	  Каталог
	  <br>
<?php
if(isset($cat_tp[0]))
{
    echo '<select name="catalog">';

    echo '<option value="0">Выбрать каталог</option>';

    foreach($cat_tp[0] as $value)
    {
	echo '<optgroup label="'.$value->name.'">';

	if(isset($cat_tp[$value->id]))
	{
	    foreach($cat_tp[$value->id] as $val)
	    {
		echo '<option value="'.$val->id.'">'.$val->name.'</option>';
	    }
	}

	echo '</optgroup>';
    }

    echo '</select>';
}

?>

	    <hr>
	    Дополнительные поля<br><br>

	    <div class="wrap_dop_content">
		<div class="wrap_dop">
		    Название поля: <input class="name_field" type="text" value=""> Текст: <input class="value_field" name="" type="text" value="">
		</div><br><br>
	    </div>

	    <a id="add_field" href="#">Добавить поле</a><br><br>


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
		      <div class="title">'.$value->name.'</div>
		      <div class="content">';

	    if(isset($cat_tp[$value->id]))
	    {

		echo '<table>
			    <thead>
			    <tr>
				<th style="width:300px;">Название</th>
			    </tr>
			    </thead>
			    <tbody>';

		foreach($cat_tp[$value->id] as $val)
		{

		    echo  '<tr>
				<td><a href="/uniqbox/modules/catalog/?cat='.$val->id.'">'.$val->name.'</a></td>
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
}
elseif(isset($_REQUEST['cat']))
{
	$cat_name = Functions::get_catalogtype_one($_REQUEST['cat']);

	$catalog = Functions::get_catalog_objects();

	echo '<div class="cb"></div>
		  <div class="bloc">
		      <div class="title">'.$cat_name->name.'</div>
		      <div class="content">';


		echo '<table>
			    <thead>
			    <tr>
				<th style="width:200px;">Тип</th>
				<th style="width:300px;">Город, р-н, метро</th>
				<th style="width:200px;">Тип дома</th>
				<th style="width:200px;">Этаж</th>
				<th style="width:200px;">Площадь</th>
				<th style="width:200px;">Цена</th>
				<th style="width:200px;">Комнат</th>
				<th style="width:200px;">Добавлен</th>
				<th style="width:200px;">Действия</th>
			    </tr>
			    </thead>
			    <tbody>';

		foreach($catalog as $val)
		{

		    $sq = json_decode($val->sq);

		    echo  '<tr>
				<td>'.$type_array[$val->type].'</td>
				<td>'.$val->city.'</td>
				<td>'.$val->type_house.'</td>
				<td>'.$val->floor.'</td>
				<td>'.$sq[0].' м</td>
				<td>'.$val->price.'</td>
				<td>'.$val->rooms.'</td>
				<td>'.date("d.m.Y",$val->timestamp).'</td>
				<td style="padding: 8px 0;">
				    <a href="/uniqbox/modules/catalog/?id='.$val->id.'">Просмотреть</a><br><br>
				    <a class="catalog_item_delete" style="color:red;" href="/ajax/catalog_item_delete?id='.$val->id.'">Удалить</a>
				</td>
			    </tr>';

		}

		echo '</tbody>
		      </table>';

	echo '</div>
		  </div>
		  <div class="cb"></div>';

}
elseif(isset($_REQUEST['id']))
{

    $object = Functions::get_catalog_one_object($_REQUEST['id']);

    $sq = json_decode($object->sq);
    $data = json_decode($object->data);
?>
<div class="cb"></div>
<div class="bloc">
    <div class="title">Редактирование</div>
    <div class="content">
	<form action="/ajax/catalog_item_add?id=<?=$object->id?>" method="post">

	  Тип
	  <select name="type">
<?php
    foreach($type_array as $key=>$value){
	  $selected = '';
	  if($object->type == $value) $selected = 'selected';

	  echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
?>
	  </select><br>
	  Город, район, метро
	  <br>
	  <textarea name="city" style="width:300px;height:50px;"><?=$object->city?></textarea><br><br>
	  Адрес
	  <br>
	  <textarea name="address" style="width:300px;height:50px;"><?=$object->address?></textarea><br><br>

	  Тип дома
	  <br>
	  <div class="input"><input name="type_house" type="text" value="<?=$object->type_house?>"></div><br>

	  Этаж / Кол-во этажей
	  <br>
	  <div class="input"><input name="floor" type="text" value="<?=$object->floor?>"></div><br>

	  Кол-во комнат
	  <br>
	  <div class="input"><input name="rooms" type="text" value="<?=$object->rooms?>"></div><br><hr>

	  Площадь объекта (общая) метры
	  <br>
	  <div class="input"><input name="sq[0]" type="text" value="<?=$sq[0]?>"></div><br>

	  Площадь объекта (жилая) метры
	  <br>
	  <div class="input"><input name="sq[1]" type="text" value="<?=$sq[1]?>"></div><br>

	  Площадь объекта (кухня) метры
	  <br>
	  <div class="input"><input name="sq[2]" type="text" value="<?=$sq[2]?>"></div><br><hr>

	  Стоимость руб.
	  <br>
	  <div class="input"><input name="price" type="text" value="<?=$object->price?>"></div><br>

	  Статус дома (новостройка, и т.п.)
	  <br>
	  <div class="input"><input name="status_house" type="text" value="<?=$object->status_house?>"></div><br>

	  Каталог
	  <br>
<?php
if(isset($cat_tp[0]))
{
    echo '<select name="catalog">';

    echo '<option value="0">Выбрать каталог</option>';

    foreach($cat_tp[0] as $value)
    {
	echo '<optgroup label="'.$value->name.'">';

	if(isset($cat_tp[$value->id]))
	{
	    foreach($cat_tp[$value->id] as $val)
	    {
		$selected = '';
		if($object->catalog == $val->id) $selected = 'selected';

		echo '<option value="'.$val->id.'" '.$selected.'>'.$val->name.'</option>';
	    }
	}

	echo '</optgroup>';
    }

    echo '</select>';
}

if($data != '')
{
?>
	    <hr>
	    Дополнительные поля<br><br>
<?php
    foreach($data as $key=>$value)
    {
	 echo $key.' <input class="value_field" name="data['.$key.']" type="text" value="'.$value.'"><br><br>';

    }
}
?><br>
	    <div class="submit"><input type="submit" value="Сохранить"></div>
	</form>
    </div>
</div>

<?php
}
?>