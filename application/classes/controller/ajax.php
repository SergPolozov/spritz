<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by JetBrains PhpStorm.
 * User: Sergey
 * Date: 25.10.12
 * Time: 9:34
 * To change this template use File | Settings | File Templates.
 */

class Controller_Ajax extends Controller {
    public $template = "main";
    public $params = Array();
    public $user;
    public function action_index()
    {
        echo date("Y-m-d H:i a");
    }
    public function add_to_basket(){
        Functions::add_to_basket($_REQUEST["id"]);
    }
    public function action_add_page(){
        Functions::NewPage($_REQUEST["url"],$_REQUEST["name"],$_REQUEST["type"],$_REQUEST["parent"]);
    }

    public function action_doc_marked (){
        Functions::doctorMarked($_REQUEST["doctor_id"], $_REQUEST["checked"]);
        return;
    }

    public function action_meta_save (){
        Functions::metaSave($_REQUEST, $_REQUEST["page_id"]);
    }

    public function action_page_module (){
        Functions::pageModule($_REQUEST, $_REQUEST["page_id"]);
    }
    public function action_page_on_menu (){
        Functions::pageDeleteFromMenu($_REQUEST, $_REQUEST["page_id"]);
    }
    public function action_save_price (){
        Functions::priceSave();
    }

    public function action_logout(){
        Auth::instance("admin")->logout(true);
    }

    public function action_login(){
        $user = Auth::instance("admin")->login($_REQUEST["login"], $_REQUEST["password"]);
        $user = Auth::instance("admin")->get_user();
        if ($user != "" &&$user->admin==1)
            echo "1";
        else
            echo "0";
    }
    public function action_login_client(){
        $user = Auth::instance()->login($_REQUEST["login"], $_REQUEST["password"]);
        if ($user != ""){
            echo "1";
            Functions::LoadBasket();
        }
        else
            echo "0";
    }
    public function action_save(){
         $user = Auth::instance()->get_user();
        if($user!=""){
            $array =array();
            if($user->data!=""){
                $array=  json_decode($user->data,true);
            }
            foreach($_POST as $key=>$element){
                if(isset($user->{$key})){
                    $user->{$key}=$element;
                }else{
                    $array[$key]=$element;
                }
            }
            $user->data= json_encode($array);
            $user->save();
        }

    }
    public function action_opinion_new (){
        Functions::opinionNew($_REQUEST);
        echo "1";
    }

    public function action_op_publish (){
        Functions::opinionPublish($_REQUEST["op_id"], $_REQUEST["publish"]);
    }

    public function action_recording_new (){
        Functions::recordingNew($_REQUEST);
        echo "1";
    }

    public function action_rec_publish (){
        Functions::recordingPublish($_REQUEST["rec_id"], $_REQUEST["publish"]);
    }

    public function action_faq_new (){
        Functions::faqNew($_REQUEST);
        echo "1";
    }

    public function action_faq_publish (){
        Functions::faqPublish($_REQUEST["faq_id"], $_REQUEST["publish"]);
    }

    public function action_banner_save (){
        Functions::bannerSave($_REQUEST);
    }

    public function action_doctors_page_save (){
        echo Functions::pageDoctorsSave($_REQUEST["page_id"], $_REQUEST["doctor_id"], $_REQUEST["checked"]);
    }
    public function action_change_order(){
        Functions::change_order($_REQUEST["id"],$_REQUEST['up']);
    }


    public function action_catalog_type_add(){
        $user = Auth::instance("admin")->get_user();
        if($user!=""){

	      $catalogtype = ORM::factory("catalogtype");
	      $catalogtype->name = $_REQUEST["name"];
	      $catalogtype->url = $_REQUEST["url"];
	      $catalogtype->parent = $_REQUEST["parent"];
	      $catalogtype->save();

	      header("Location: /uniqbox/modules/catalog_type/");
	      exit;
	      
        }

    }

    public function action_catalog_type_delete(){
        $user = Auth::instance("admin")->get_user();
        if($user!=""){
            
	      $id = $_REQUEST['id'];

	      $catalogtype = ORM::factory("catalogtype")->where('id','=',$id)->find();
	      $catalogtype->delete();

	      $catalogdel = ORM::factory("catalogtype")->where('parent','=',$id)->find_all();

	      foreach($catalogdel as $value)
	      {
		  $catalogtype = ORM::factory("catalogtype")->where('id','=',$value->id)->find();
		  $catalogtype->delete();
	      }

	      header("Location: /uniqbox/modules/catalog_type/");
	      exit;
	      
        }

    }

    public function action_catalog_item_add(){
        $user = Auth::instance("admin")->get_user();
        if($user!=""){
            
	  if(isset($_REQUEST['id']))
	  {
	      $catalog = ORM::factory("catalog")->where('id','=',$_REQUEST['id'])->find();
	  }
	  else
	  {
	      $catalog = ORM::factory("catalog");
	  }
	      $catalog->type = $_REQUEST['type'];
	      $catalog->city = $_REQUEST['city'];
	      $catalog->address = $_REQUEST['address'];
	      $catalog->rooms = $_REQUEST['rooms'];
	      $catalog->type_house = $_REQUEST['type_house'];
	      $catalog->floor = $_REQUEST['floor'];
	      $catalog->sq = json_encode($_REQUEST['sq']);
	      $catalog->price = $_REQUEST['price'];
	      $catalog->status_house = $_REQUEST['status_house'];
	      $catalog->catalog = $_REQUEST['catalog'];

	      if(isset($_REQUEST['data'])){
		  $catalog->data = json_encode($_REQUEST['data']);
	      }
	      $catalog->timestamp = time();
	      $catalog->save();

	      header('Location: /uniqbox/modules/catalog/?id='.$catalog->id);
	      exit;
	      
        }

    }

    public function action_catalog_item_delete(){
        $user = Auth::instance("admin")->get_user();
        if($user!=""){
            
	  if(isset($_REQUEST['id']))
	  {
	      $catalog = ORM::factory("catalog")->where('id','=',$_REQUEST['id'])->find();

	      $cat = $catalog->catalog;

	      $catalog->delete();
	  }

	  header('Location: /uniqbox/modules/catalog/?cat='.$cat);
	  exit;
	      
        }

    }


    public function action_save_settings(){
        $user = Auth::instance("admin")->get_user();
        if($user!=""){
            
	
	      $catalog = ORM::factory("settings")->where('id','=',$_REQUEST['id'])->find();

	      $catalog->text = $_REQUEST['top_text'];

	      $catalog->save();


	  header('Location: /uniqbox/modules/settings/');
	  exit;
	      
        }

    }

    public function action_save_razdel_input(){
        $user = Auth::instance("admin")->get_user();
        if($user!=""){
            

	      $catalog = ORM::factory("catalogtype")->where('id','=',$_REQUEST['id'])->find();

	      $catalog->name = $_REQUEST['val'];

	      $catalog->save();

	      
        }

    }


   public function action_ckeditorUpload(){

        $user = Auth::instance("admin")->get_user();
        if(isset($user) && $user->admin == 1)
        {
	    
	    $file = Functions::uploadFile('upload', '/media/upload/user_image/');
	    $full_path = 'http://'.$_SERVER['HTTP_HOST'].'/media/upload/user_image/'.$file;

	    $callback = $_REQUEST['CKEditorFuncNum'];

	    echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'","Файл загружен" );</script>';

	}
   }


    public function action_send_message(){

	    $email = ORM::factory("settings")->where('id','=','3')->find();

	    $subj = "Новое сообщение на сайте";

	    $msg = "<br />имя: " . $_REQUEST["name"];
	    $msg .= "<br />email: " . $_REQUEST["email"];
	    $msg .= "<br />телефон: " . $_REQUEST["phone"];
	    $msg .= "<br />сообщение: " . $_REQUEST["text"];

	    Functions::sendmail($email->text, array("title"=>$subj, "text"=>$msg));


	    echo 1;


    }

}