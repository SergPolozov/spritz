<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 21.10.12
 * Time: 17:35
 * To change this template use File | Settings | File Templates.
 */
define("SEARCHLIMIT",10);
class Functions
{
    public static $tempalte=  "main";

    Public static $type =array("Вилла","Аппартаменты","Бизнес","Инвестиции");
    public static $catalogchecked= array("show_price","pool","garage","seaview","terrase","new","best");
    public static function AllRender(){
           $pages = ORM::factory("structure")->find_all();

        foreach($pages as $element){

            $element->save();
        }

    }

    public static function NewPage($url,$name,$type,$parent){
        if($parent!=0){
        $parentobj =Functions::pageGet(array("id"=>$parent));

        $tar = explode("/",$parentobj->url);
        $tar[]=$url;
        $url = implode("/",$tar);
        }
        $page =Functions::pageGet(array("url"=>$url));
        $page->url = $url;
        $page->name = $name;
        $page->type=$type;
        $page->parent=$parent;
        $page->save();

    }
    public static function EditModulePage($args){
        if(isset($args["el_id"])&&$args["el_id"]!=""){
            $page =Functions::pageGet(array("id"=>$args["el_id"]));
            if(!isset($args["type"])||$args["type"]==""){
               $args["type"]="file";
            }
        }else{
            if(!isset($args["type"])||$args["type"]==""){
               $args["type"]="file";
            }
            $page =Functions::pageGet();
            $page->type=isset($args["type"])?$args["type"]:"file";
            $page->save();
        }
        switch($args["type"]){
            case "image":
                $count = ORM::factory("structure")->where("parent","=",$args["parent"])->count_all();
                if($args["parent"]<0){
                    $parent =Functions::moduleGet(array("id"=>$args["parent"]*-1));
                }else{
                    $parent =Functions::pageGet(array("id"=>$args["parent"]));
                }

                $url = $parent->url."_".($count+1);
                $img ="/media/userfiles/images/".self::uploadPhoto("img");
                   $page->src = $img;
                break;
            case "catalog":
                $page->type = $args["type"];
            case "slider":
                $page->type = $args["type"];
                $img ="/media/userfiles/images/".self::uploadPhoto("img");
                   $page->img = $img;
            default:
		if(!isset($args["url"])){
		    $count = ORM::factory("structure")->count_all();
		    $args["url"] = 'page_'.$count;
		}

                $url = explode("/",$args["url"]);
                $url  = $url[count($url)-1];
                if($args["parent"]<0){
                    $parent =Functions::moduleGet(array("id"=>$args["parent"]*-1));

                    $tar = explode("/",$parent->url);
                    $tar[]=$url;
                    $url = implode("/",$tar);
                }else{
                    $parent =Functions::pageGet(array("id"=>$args["parent"]));
                    if($parent->url!=""){
                        $tar = explode("/",$parent->url);
                        $tar[]=$url;
                        $url = implode("/",$tar);
                    }
                }
                if($page->url!=$url){
                    self::ReplaceFile($page->url,$url);
                }
                break;
        }

        $page->url =$url;
        $page->name = $args["name"];

        if(isset($args["order"]))
        {
            $page->order = $args["order"];
        }

        $page->parent=$args["parent"];
        $page->save();


        if(isset($args["content"])){

            $page->content =$args["content"];
        }
        $page->save();
        return $page;

    }
    public static function ReplaceFile($oldurl,$newurl){
        if(!file_exists(APPPATH . "views/pages/" . $oldurl . ".php")){
            return;
        }
        $data = file_get_contents(APPPATH . "views/pages/" . $oldurl . ".php");
        $tar = explode("/",$newurl);
        $str =APPPATH . "views/pages/";
        for($i=0;$i<count($tar)-1;$i++){
           $str.=$tar[$i]."/";
        }
        if(!is_dir($str)){
            mkdir($str,0777,true);
        }
        $file = fopen (APPPATH . "views/pages/" . $newurl . ".php", "w");

        fputs($file, $data);
        fclose($file);
        unlink(APPPATH . "views/pages/" . $oldurl . ".php");
        try{
            chmod(APPPATH . "views/pages/" . $newurl . ".php", 0777);
        } catch (Exception $e){

        }
    }

    public static function dateConvert($timestamp){
        $months = array(
            "",
            "января",
            "февраля",
            "марта",
            "апреля",
            "мая",
            "июня",
            "июля",
            "августа",
            "сентября",
            "октбяря",
            "ноября",
            "декабря"
        );
        $array = explode(" ", $timestamp);
        $date = explode("-", $array[0]);
        $time = explode(":", $array[1]);
        return $date[2] . " " . $months[$date[1]] . " " . $date[0] .", " . $time[0] . ":" . $time[1];
    }

    public static function sendmail($email,$args){
        $from ="Недвижимость <noreply@expspb.ru>";
        $to  =$email;
        $subj="=?utf-8?B?".base64_encode($args["title"])."?=";
        $text=$args["text"];
        $un = strtoupper(uniqid(time()));
        $head = "Content-type: text/html; charset=\"utf-8\"\n";
        $head .= "From: $from\n";
        $head .= "To: $to\n";
        $head .= "Subject: $subj\n";
        $head .= "X-Mailer: PHPMail Tool\n";
        $head .= "Reply-To: $from\n";
        $head .= "Mime-Version: 1.0\n";


        $zag =  $text;
        // echo  $head.$zag;
        if (!mail($to, $subj, $zag, $head)) return 0; else return 1;


    }

    public static function uploadPhoto ($src, $uploadpath="/media/userfiles/images",$type=""){
        if(!isset($_FILES[$src]["tmp_name"])){

            return false;
        }
        $uploads_dir = $_SERVER["DOCUMENT_ROOT"] . $uploadpath;
        if(!is_dir($uploads_dir)){
            mkdir($uploads_dir,0777,true);
        }
        if ($type == ""){

            $tmp_name = $_FILES[$src]["tmp_name"];
            $name = $_FILES[$src]["name"];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        } elseif ($type == "price") {

            $tmp_name = $_FILES[$src]["tmp_name"];
            $name = "price.xls";
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        }
        //chmod ($uploads_dir, 0777);
        return $name;
    }

    public static function uploadFile ($file, $path, $begin="1") {
        if(!isset($_FILES[$file]["tmp_name"])){
            return false;
        }
        $uploads_dir = $_SERVER["DOCUMENT_ROOT"] . $path;
        if(!is_dir($uploads_dir)){
            mkdir($uploads_dir,0777,true);
        }
        $uploaddir = $_SERVER["DOCUMENT_ROOT"] . $path . "/";
        if($_FILES[$file]['name']==""){
            return "noupload";
        }$file_Name = $_FILES[$file]["name"];
        $file_TmpName = $_FILES[$file]["tmp_name"];
        $fileArray = explode (".", basename($file_Name));
        $uploadfile = $uploaddir . $begin . "." . $fileArray[count($fileArray)-1];
        $i = $begin;
        while (file_exists($uploadfile)) {
            $uploadfile = $uploaddir . $i . "." . $fileArray[count($fileArray)-1];
            $i++;
        }
        if ($i!=1){
            $i--;
            $filename = $i . "." . $fileArray[count($fileArray)-1];
        } else {
            $filename = $begin . "." . $fileArray[count($fileArray)-1];
        }

        move_uploaded_file($file_TmpName, $uploadfile);
        return $filename;
    }

    public static function pagesGet ($idParent="0"){
        $pages = ORM::factory("structure")->where("parent","=",$idParent)->where("on_menu",'=',1)->find_all();
        return $pages;
    }

    public static function pageGetbyUrl ($url){
        $page = ORM::factory("structure")->where("url","=",$url)->find();
        return $page;
    }
    public static function pageDeleteFromMenu($data,$id){
        $page = ORM::factory("structure")->where("id","=",$id)->find();
        $page->on_menu = $data["checked"];
        $page->save();
        Functions::AllRender();
    }
    public static function pageGetbyId ($id){
        $page = ORM::factory("structure")->where("id","=",$id)->find();
        return $page;
    }
    public static function DeleteById($id){
        $page = ORM::factory("structure")->where("id","=",$id)->find();
        $page->delete();
    }
    public static function pageGet($params=array()){
        if (isset($params["url"])){
            $page = ORM::factory("structure")->where("url", "=", $params["url"])->find();
        } elseif (isset($params["id"])){
            $page = ORM::factory("structure")->where("id", "=", $params["id"])->find();
        } else {
            $page = ORM::factory("structure");
        }


        return $page;
    }
  public static function deleteImg($params, $id=""){
      $page = Functions::pageGet(array("id"=>$id));

      switch($page->type){
          case "catalog":
              $gallery=array();
              if($page->imgs!=""){
                  $gallery = json_decode($page->imgs,true);
              }
              if(isset($_REQUEST["deleteImg"])&&$_REQUEST["deleteImg"]==1){

                  unset($gallery[$_REQUEST["key"]]);
              }
              $page->imgs = json_encode($gallery);
              break;
      }
      $page->save();
  }
    public static function pageEdit($params, $id=""){

        $page = Functions::pageGet(array("id"=>$id));

        switch($page->type){

            case "catalog":
                      $img =self::uploadPhoto("img","/media/userfiles/images/$page->id");

                      if($img!=false){
                          $img ="/media/userfiles/images/$page->id/".$img;
                          $page->img = $img;

                          $root_img = $_SERVER['DOCUMENT_ROOT'].$img;

                          $image = Image::factory($root_img);
                          $image->resize(300, 300, Image::AUTO);
                          $image->save();
                      }

                      $page->smalltext = $params["smalltext"];
                      $page->articul = $params["articul"];
                      $page->price_one = $params["price_one"];
                      $page->price_opt = $params["price_opt"];
                      $page->alt_img = $params["alt_img"];

                      if(isset($params["on_main"]))
                      {
                          $page->on_main = 1;
                      }
                      else
                      {
                          $page->on_main = 0;
                      }

                      if(isset($params["on_top"]))
                      {
                          $page->on_top = 1;
                      }
                      else
                      {
                          $page->on_top = 0;
                      }

                      if(isset($params["type_content"]))
                      {
                          $page->type_content = 1;
                      }
                      else
                      {
                          $page->type_content = 0;
                      }

                      break;
           case "news":
                    $img =self::uploadPhoto("img","/media/userfiles/images/$page->id");

                    if($img!=false){
                        $img="/media/userfiles/images/$page->id/".$img;
                        $page->img = $img;
                    }
                    $page->smalltext = $params["smalltext"];

                    $date = explode('/',$params["date"]);

                    $page->timestamp = strtotime($date[2].'-'.$date[0].'-'.$date[1]);

                    break;
           case "specialist":
                    $img =self::uploadPhoto("img","/media/userfiles/images/$page->id");

                    if($img!=false){
                        $img="/media/userfiles/images/$page->id/".$img;
                        $page->img = $img;
                    }
                    $page->smalltext = $params["smalltext"];

                    $date = explode('/',$params["date"]);

                    $page->timestamp = strtotime($date[2].'-'.$date[0].'-'.$date[1]);

                    break;
           case "articles":
                    $img =self::uploadPhoto("img","/media/userfiles/images/$page->id");

                    if($img!=false){
                        $img="/media/userfiles/images/$page->id/".$img;
                        $page->img = $img;
                    }
                    $page->smalltext = $params["smalltext"];

                    $date = explode('/',$params["date"]);

                    $page->timestamp = strtotime($date[2].'-'.$date[0].'-'.$date[1]);

                    break;
            case "feedback":
                    $page->email = $params["email"];

                    $date = explode('/',$params["date"]);

                    $page->timestamp = strtotime($date[2].'-'.$date[0].'-'.$date[1]);

                    break;
            case "portfolio":
                $img =self::uploadPhoto("img","/media/userfiles/images/$page->id");

                if($img!=false){
                    $img="/media/userfiles/images/$page->id/".$img;
                    $page->img = $img;
                }
               // $page->smalltext = $params["smalltext"];
                break;
            case "uslugi":
                $page->uparent = $params["uparent"];
		$page->price = $params["price"];
		if($params["uparent"] != 0)
		{
		    $page->on_menu = 0;
		}
                break;
            case "slider":
                    $page->text1 = $params["text1"];

                    $page->link = $params["link"];
                    $img =self::uploadPhoto("img","/media/userfiles/images/$page->id");

                    if($img!=false){
                        $img="/media/userfiles/images/$page->id/".$img;
                        $page->img = $img;
                    }
                    break;
        }
	if(isset($params["text"])) $page->content = $params["text"];
        $page->save();
      /*  $file = fopen (APPPATH . "views/pages/" . $page->url . ".php", "w");
        $content = $params["text"];
        fputs($file, $content);
        fclose($file);
        try{
            chmod(APPPATH . "views/pages/" . $page->url . ".php", 0777);
        } catch (Exception $e){

        }
        self::render_page();*/
        return;
    }





    private static function _modulesGetContent ($idParent,$recursive){

        $catalog = ORM::factory("structure")->where("parent", "=", $idParent)->order_by("order", "ASC")->find_all();
        $answer = array();
        foreach($catalog as $element){

            if($recursive==1){
                $answer[] = array("element"=> $element,"childs"=>self::_modulesGetContent($element->id,$recursive));
            }else{
                $answer[]=$element;
            }
        }
        return $answer;
    }
    public static function modulesGetContent ($id,$recursive){
        $catalog_temp = self::_modulesGetContent($id,$recursive);

        return $catalog_temp;
    }
    public static function ReturnRegionForJS(){
      $array =self::modulesGetContent(-3,1);
       $answer = array();
        foreach($array as $element){
            foreach($element["childs"] as $celement){
                $answer[] = array("label"=>$celement["element"]->name,"category"=>$element["element"]->name,"id"=>$celement["element"]->id);
            }
        }
        return $answer;

   }
    public static function modulesGetContentFlat($id){

        $answer = array();
        $catalog = ORM::factory("structure")->where("parent", "=", $id)->find_all();
        foreach($catalog as $element){
            $answer[]= $element;
            $answer =array_merge($answer,self::modulesGetContentFlat($element->id));
        }
        return $answer;
    }
    public static function GetMainMenu(){

        $answer = array();
        $catalog = ORM::factory("structure")->where("parent", "=", 0)->where("on_menu", "=", 1)->order_by("order","ASC")->find_all();
        foreach($catalog as $element){
            $answer[]= $element;

        }
        return $answer;
    }
    public static function GetMainMenuTech($id){

        $answer = array();
        $catalog = ORM::factory("structure")->where("parent", "=",$id)->where("on_menu", "=", 1)->order_by("order", "ASC")->find_all();
        foreach($catalog as $element){
            $answer[]=array("obj"=> $element,"child"=>self::GetMainMenuTech($element->id));

        }
        return $answer;
    }
    public static function metaSave ($params, $id){
        $page = self::pageGet(array("id"=>$id));


        if (isset($params["title"]))
            $page->meta_title = $params["title"];
        if (isset($params["meta_key"]))
            $page->meta_key = $params["meta_key"];
        if (isset($params["meta_descr"]))
            $page->meta_descr = $params["meta_descr"];

        $page->save();

    }






    public static function modulesGet (){
        $modules = ORM::factory("modules")->find_all()->as_array("bitmask");
        return $modules;
    }
    public static function moduleGet ($args){
        if (isset($args["url"])){
            $page = ORM::factory("modules")->where("url", "=", $args["url"])->find();
        } elseif (isset($args["id"])){
            $page = ORM::factory("modules")->where("bitmask", "=", $args["id"])->find();
        } else {
            $page = ORM::factory("modules");
        }

        return $page;
    }





    public static function pageModule($params, $id){
        if ($id <10000)
            $page = self::pageGet(array("id"=>$id));
        elseif ($id > 10000)
            $page = self::catGet(array("id"=>$id));

        if ($params["checked"] == "1")
            $page->modules = (int)$page->modules | (int)$params["bitmask"];
        if ($params["checked"] == "0")
            $page->modules = (int)$page->modules ^ (int)$params["bitmask"];

        $page->save();

    }

    //search Section

    public static function modulesSearch($table,$query,$page=1,$limit=SEARCHLIMIT){


        $cureentModule =  DB::select()->from($table);
        Foreach($query as $key=>$element){
            if(!Model_Structure::check_fieldstat($key,$table)){
                continue;
            }

            if(is_array($element)){
                if(count($element)==2){
                    $cureentModule=$cureentModule->where($key,">=",$element[0]);
                    $cureentModule=$cureentModule->where($key,"<=",$element[1]);
                }else{
                    $cureentModule=$cureentModule->where($key,"IN",$element);
                }

            }else{
                $cureentModule=$cureentModule->where($key,"=",$element);
            }

        }
        $result =$cureentModule->offset(($page-1)*$limit)->limit($limit)->execute();
        $sorted_result=array();
        $ids= array();
        foreach($result as $element){
            $ids[]= $element["id"];
            $sorted_result[$element["id"]]=$element;
        }
        $objects = ORM::factory("structure")->where("id","IN",$ids)->find_all();
        $answer = array();
        foreach($objects as $element){
            $element->add_cache($sorted_result[$element->id]);
            $answer[]= $element;
        }
        return $answer;

    }
    public static function  add_to_basket($id,$count=1){
        $session = Session::instance();
        $basket =$session->get("basket");
        $user = Auth::instance()->get_user();
        if($basket==""&&$user!=""){
            $basketorm = ORM::factory("basket")->where("uid","=",$user->id)->where("status","=",0)->find_all();
            if($basketorm->data!=""){
            $basket = json_decode($basketorm->data,true);
            }

        }
        if($basket==""){
            $basket= array();
        }
        $basket[$id] = array("id"=>$id,"amount"=>$count);
        if($user!=""){
            $basketorm = ORM::factory("basket")->where("uid","=",$user->id)->where("status","=",0)->find_all();
            $basketorm->data = json_encode($basket);
            $basketorm->save();

        }
       $session->set("basket",$basket);
    }
    public static function returnBasketId(){
        $session = Session::instance();
        $basket =$session->get("basket");

        if($basket==""){
            $basket= array();
        }
        $id_array= array();
        foreach($basket as $element){
            $id_array[] = $element["id"];

        }
        return $id_array;
    }
    public static  function LoadBasket(){
            $session = Session::instance();
            $basket =$session->get("basket");
            $user = Auth::instance()->get_user();
            if($basket==""&&$user!=""){
                $basketorm = ORM::factory("basket")->where("uid","=",$user->id)->where("status","=",0)->find_all();
                if($basketorm->data!=""){
                    $basket = json_decode($basketorm->data,true);
                    $session->set("basket",$basket);
                }

            }

        }
    public static function  change_order($id,$up){
        $object = ORM::factory("structure")->where("id","=",$id)->find();
        $all_child = ORM::factory("structure")->where("parent","=",$object->parent)->find();
        foreach($all_child as $element){
            if($up==true){
                if($element->order==$object->order-1){
                    $element->order = $object->order;
                    $element->save();
                    $object->order =$object->order-1;
                    $object->save();
                    break;
                }
            }else{
                if($element->order==$object->order+1){
                    $element->order = $object->order;
                    $element->save();
                    $object->order =$object->order+1;
                    $object->save();
                    break;
                }
            }

        }
    }

    public static function modules_get_one($type){

	$objects = ORM::factory("structure")->where("parent","=",$type)->order_by('id','desc')->find();
	return $objects;
    }

    public static function modules_get_count($type){

	$objects = ORM::factory("structure")->where("parent","=",$type)->count_all();
	return $objects;
    }

    public static function modules_get_table($type,$limit=null){

	if(isset($limit))
	{
	      $objects = ORM::factory("structure")->where("parent","=",$type)->limit($limit)->order_by('id', 'DESC')->find_all();

	}
	else
	{
	      $objects = ORM::factory("structure")->where("parent","=",$type)->order_by('id', 'DESC')->find_all();

	}

	return $objects;

    }

    public static function modules_get_table_order($type,$limit=null){

        if(isset($limit))
        {
              $objects = ORM::factory("structure")->where("parent","=",$type)->limit($limit)->order_by('order', 'asc')->find_all();


        }
        else
        {
              $objects = ORM::factory("structure")->where("parent","=",$type)->order_by('order', 'asc')->find_all();

        }


        return $objects;

    }


    public static function modules_get_table_menu($type){

        $objects = ORM::factory("structure")->where("parent","=",$type)->where('type_content','=',1)->order_by('order', 'asc')->find_all();

        return $objects;

    }

    public static function get_footer_contacts(){

          $objects = ORM::factory("structure")->where("url","=","footer_contacts")->find();
          return strip_tags($objects->content,'<strong><em><b><i>');
    }


    public static function draw_menu($element)
    {
	$content = '';
	if(isset($element['child']) && $element['child'] != '' && count($element['child']) > 0)
	{
	    $content .= '<ul class="submenu_1">';
	    foreach($element['child'] as $value){
		    $content .= '<li><a href="#!/';

		    if ($value['obj']->url != "main") $content .= $value['obj']->url;

		    $content .= '">';

		    $content .= $value['obj']->name;

		    $content .= '</a>';

		    $content .= self::draw_menu($value);

		    $content .= '</li>';

	    }
	    $content .= '</ul>';
	 }
	 return $content;
    }

    public static function get_catalogtype()
    {
	  $catalogtype = ORM::factory("catalogtype")->order_by('id','asc')->find_all();

	  $cat_tp = array();

	  foreach($catalogtype as $value)
	  {
	      $cat_tp[$value->parent][$value->id] = $value;

	  }

	  return $cat_tp;
    }

    public static function get_catalog_objects()
    {
	  $catalog = ORM::factory("catalog")->where('catalog','=',$_REQUEST['cat'])->order_by('timestamp','desc')->find_all();

	  return $catalog;
    }

    public static function get_catalog_one_object($id)
    {
	  $catalog = ORM::factory("catalog")->where('id','=',$id)->find();

	  return $catalog;
    }

    public static function get_catalogtype_one($id)
    {
	  $catalogtype = ORM::factory("catalogtype")->where('id','=',$id)->find();
	  return $catalogtype;
    }

    public static function get_per_page()
    {
	  $catalog = ORM::factory("settings")->where('id','=',"2")->find();

	  return $catalog->text;
    }

/*
    public static function newsEdit($params, $id){
        if ($id != "")
            $obj = self::pageGet(array("id" => $id));
        else
            $obj = self::pageGet(array());

        if (isset($params["name"]))
            $obj->name = $params["name"];
        if (isset($params["url"]))
            $obj->url = $params["url"];
        if (isset($params["url"]))
            $obj->content = $params["content"];

        $obj->parent = "23";

        $obj->save();

    }

    public static function newsDel($id){
        $obj = self::pageGet(array("id" => $id));

        $obj->delete();
        self::render_page();
    }


    public static function priceSave(){
        self::uploadPhoto("price", "price");
    }

    public static function faqsGet(){
        $faqs = array ();
        $faqs["q"] = array();
        $faqs["a"] = array();
        $faqs_temp = ORM::factory("faq")->where("parent", "=", "0")->order_by("date", "desc")->find_all();
        foreach ($faqs_temp as $faq){
            $faqs["q"][] = $faq;
            $faq_temp = ORM::factory("faq")->where("parent", "=", $faq->id)->find();
            if (isset($faq_temp->id)){
                $faqs["a"][$faq->id][] = $faq_temp;
            }
        }
        return $faqs;
    }

    public static function faqNew($params){
        $faq = ORM::factory("faq");
        $faq->name = $params["name"];
        $faq->email = $params["email"];
        $faq->text = $params["comment"];
        $faq->save();
        $subj = "Новая вопрос-ответ на сайте";
        $msg = "<b>На сайте клиники новый вопрос.</b>";
        $msg .= "<br />имя: " . $params["name"];
        $msg .= "<br />email: " . $params["email"];
        $msg .= "<br />комментарий: " . $params["comment"];
        self::sendmail("invita@list.ru", array("title"=>$subj, "text"=>$msg));
        self::sendmail("serg.polozov@gmail.com", array("title"=>$subj, "text"=>$msg));
    }

    public static function faqDel($id){
        $faq = ORM::factory("faq")->where("id", "=", $id)->find();
        $faq->delete();
        self::render_page();
    }

    public static function faqGet($id){
        $faq = ORM::factory("faq")->where("id", "=", $id)->find();
        return $faq;
    }

    public static function faqEdit($params, $id){
        if ($id != "")
            $obj = ORM::factory("faq")->where("id", "=", $id)->find();
        else
            $obj = ORM::factory("faq");

        if (isset($params["name"]))
            $obj->name = $params["name"];
        if (isset($params["content"]))
            $obj->text = $params["content"];
        if (isset($params["faq_parent"]) && $params["faq_parent"] != "-1")
            $obj->parent = $params["faq_parent"];

        $obj->save();
        self::render_page();
    }

    public static function faqPublish($id, $publish){
        $faq = ORM::factory("faq")->where("id", "=", $id)->find();
        $faq_id = $faq;
        $faq->publish = $publish;
        $faq->save();
        $faq = ORM::factory("faq")->where("parent", "=", $id)->find();
        if (isset($faq->publish)){
            $faq->publish = $publish;
            $faq->save();
        }
        $faq = ORM::factory("faq")->where("id", "=", $faq_id->parent)->find();
        if (isset($faq->publish)){
            $faq->publish = $publish;
            $faq->save();
        }
        self::render_page();
    }

    public static function recordingsGet(){
        $recordings = ORM::factory("recording")->order_by("date", "desc")->find_all();
        return $recordings;
    }

    public static function recordingNew ($params){
        $recording = ORM::factory("recording");
        $recording->dateText = $params["chooseDate"];
        $recording->doctor = $params["doctor"];
        $recording->name = $params["name"];
        $recording->email = $params["email"];
        $recording->phone = $params["phone"];
        $recording->text = $params["comment"];
        $recording->save();
        $subj = "Новая заявка на запись на приём";
        $msg = "<b>На сайте клиники новая запись.</b>";
        $msg .= "<br />время записи: " . self::dateConvert(date("Y-m-d H:i"));
        $msg .= "<br />на дату: " . $params["chooseDate"];
        $msg .= "<br />к доктору: " . $params["doctor"];
        $msg .= "<br />имя: " . $params["name"];
        $msg .= "<br />email: " . $params["email"];
        $msg .= "<br />телефон: " . $params["phone"];
        $msg .= "<br />комментарий: " . $params["comment"];
        self::sendmail("invita@list.ru", array("title"=>$subj, "text"=>$msg));
        self::sendmail("serg.polozov@gmail.com", array("title"=>$subj, "text"=>$msg));
    }

    public static function recordingPublish ($id, $publish){
        $recording = ORM::factory("recording")->where("id", "=", $id)->find();
        $recording->publish = $publish;
        $recording->save();
        self::render_page();
    }

    public static function recordingDel ($id){
        $recording = ORM::factory("recording")->where("id", "=", $id)->find();
        $recording->delete();
        self::render_page();
    }

    public static function opinionsGet($publish="1"){
        $opinions = ORM::factory("opinions")->where("publish", "=", $publish)->find_all();
        if ($publish == "0")
            $opinions = ORM::factory("opinions")->find_all();
        return $opinions;
    }

    public static function opinionNew($params){
        $opinion = ORM::factory("opinions");
        $opinion->name = $params["name"];
        $opinion->email = $params["email"];
        $opinion->text = $params["comment"];
        $opinion->save();
        $subj = "Новый отзыв на сайте";
        $msg = "<b>На сайте клиники новый отзыв.</b>";
        $msg .= "<br />имя: " . $params["name"];
        $msg .= "<br />email: " . $params["email"];
        $msg .= "<br />комментарий: " . $params["comment"];
        self::sendmail("invita@list.ru", array("title"=>$subj, "text"=>$msg));
        self::sendmail("serg.polozov@gmail.com", array("title"=>$subj, "text"=>$msg));

    }

    public static function opinionPublish ($id, $publish){
        $opinion = ORM::factory("opinions")->where("id", "=", $id)->find();
        $opinion->publish = $publish;
        $opinion->save();
        self::render_page();
    }

    public static function opinionDel ($id){
        $opinion = ORM::factory("opinions")->where("id", "=", $id)->find();
        $opinion->delete();
    }

    public static function sliderGet($id = ""){
        if ($id != "")
            $slider = ORM::factory("slider")->where("id", "=", $id)->find();
        else
            $slider = ORM::factory("slider");

        return $slider;
    }

    public static function slidersGet(){
        $sliders = ORM::factory("slider")->find_all();
        return $sliders;
    }

    public static function sliderEdit ($params, $id){
        $slider = self::sliderGet($id);
        if (isset($params["name"]))
            $slider->name = $params["name"];
        if (isset($params["descr"]))
            $slider->descr = $params["descr"];
        if (isset($_FILES["photo"]) && $_FILES["photo"]["name"] != ""){
            $slider->photo = self::uploadPhoto("photo");
        }

        $slider->save();
        self::render_page();
    }

    public static function sliderDel($id){
        $slider = self::sliderGet($id);
        $slider->delete();
        self::render_page();
    }

    public static function bannerGet($params){
        if (isset($params["id"]))
            $banner = ORM::factory("banners")->where("id", "=", $params["id"])->find();
        if (isset($params["parent"]) && isset($params["table"])){
            $banner = ORM::factory("banners")->where("parent", "=", $params["parent"])->and_where("table", "=", $params["table"])->find();
            if (!isset($banner->id))
                $banner = false;
        }
        if (!isset($banner))
            $banner = false;
        return $banner;
    }

    public static function bannerSave($params){
        if (isset($params["id"])){
            $banner = self::bannerGet($params);
            $banner->url = $params["url"];
            $banner->photo = self::uploadPhoto("photo");
        } elseif (isset($params["parent"]) && isset($params["table"])){
            $banner = ORM::factory("banners");
            $banner->url = $params["url"];
            $banner->photo = self::uploadPhoto("photo");
            $banner->parent = $params["parent"];
            $banner->table = $params["table"];
        }
        if (isset($banner))
            $banner->save();
        self::render_page();

        echo "1";
    }
*/
}
