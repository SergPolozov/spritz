<div id="content" class="catalog_content">


<?php

if($jjj == 0)
{

?>

<h1><?=$catalogtype->name?></h1>

<table>
	<thead>
	<tr>
		<th style="width:200px;">Тип</th>
		<th style="width:300px;">Город, р-н, метро</th>
		<th style="width:300px;">Адрес</th>
		<th style="width:200px;">Тип дома</th>
		<th style="width:200px;">Этаж</th>
		<th style="width:200px;">Площадь</th>
		<th style="width:200px;">Цена</th>
		<th style="width:200px;">Комнат</th>
		<th style="width:200px;">Добавлен</th>
	</tr>
<?php

$type_array = array('0'=>'Квартира','1'=>'Комната');

	foreach($catalog as $val)
	{

	    $sq = json_decode($val->sq);

	    echo  '<tr>
			<td class="center_text">'.$type_array[$val->type].'</td>
			<td>'.$val->city.'</td>
			<td><a href="/'.$page_url.'/'.$val->id.'">'.$val->address.'</a></td>
			<td  class="center_text">'.$val->type_house.'</td>
			<td  class="center_text">'.$val->floor.'</td>
			<td  class="center_text">'.$sq[0].' м</td>
			<td  class="center_text">'.$val->price.'</td>
			<td  class="center_text">'.$val->rooms.'</td>
			<td  class="center_text">'.date("d.m.Y",$val->timestamp).'</td>
		    </tr>';

	}

?>
	</thead>
	<tbody>
</table>
<br><br>
<?php

    $num_pages=ceil($catalog_count/$per_page);
    if($num_pages > 1){
	for($i=1;$i<=$num_pages;$i++) {
	  if ($i-1 == $page_r) {
	    echo $i." ";
	  } else {
	    echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i."</a> ";
	  }
	}
    }

}
else
{
    $type_array = array('0'=>'Квартира','1'=>'Комната');
    $sq = json_decode($catalog->sq);
    $data = json_decode($catalog->data);
?>
<a href="/">Главная</a> > <a href="/catalog/<?=$catalogtype->url?>"><?=$catalogtype->name?></a> > <?=$catalog->address?>
<h1><?=$catalog->address?></h1>

<table>
	<tr>
		<td class="bold" style="width:200px;">Тип</td>
		<td style="width:400px;"><?=$type_array[$catalog->type]?></td>
	</tr>
<?php
if($catalog->city != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Город, район, метро</td>
		<td style="width:400px;"><?=$catalog->city?></td>
	</tr>
<?php
}
if($catalog->address != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Адрес</td>
		<td style="width:400px;"><?=$catalog->address?></td>
	</tr>
<?php
}
if($catalog->type_house != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Тип дома</td>
		<td style="width:400px;"><?=$catalog->type_house?></td>
	</tr>
<?php
}
if($catalog->status_house != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Статус дома</td>
		<td style="width:400px;"><?=$catalog->status_house?></td>
	</tr>
<?php
}
if($catalog->floor != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Этаж / Кол-во этажей</td>
		<td style="width:400px;"><?=$catalog->floor?></td>
	</tr>
<?php
}
if($catalog->rooms != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Кол-во комнат</td>
		<td style="width:400px;"><?=$catalog->rooms?></td>
	</tr>
<?php
}
if($sq[0] != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Площадь объекта (общая)</td>
		<td style="width:400px;"><?=$sq[0]?> м&sup2;</td>
	</tr>
<?php
}
if($sq[1] != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Площадь объекта (жилая)</td>
		<td style="width:400px;"><?=$sq[1]?> м&sup2;</td>
	</tr>
<?php
}
if($sq[2] != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Площадь объекта (кухня)</td>
		<td style="width:400px;"><?=$sq[2]?> м&sup2;</td>
	</tr>
<?php
}

if($data != '')
{

    foreach($data as $key=>$value)
    {
	 echo '	<tr>
		<td class="bold" style="width:200px;">'.$key.'</td>
		<td style="width:400px;">'.$value.'</td>
		</tr>';

    }
}

if($catalog->price != ''){
?>
	<tr>
		<td class="bold" style="width:200px;">Стоимость руб.</td>
		<td style="width:400px;"><?=$catalog->price?></td>
	</tr>
<?php
}
?>
</table>


<br>

<?php
}
?>
</div>
<br><br>