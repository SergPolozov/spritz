<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
    public $template = "main";
    public $params = Array();
    public $user;
    public function before (){
        $this->user =  Auth::instance("admin")->get_user();
        if ($this->user == ""){
            $this->template = View::factory("admin/enter");
            echo $this->template;
            exit;
        } else {
        }

    }
    public function action_render_all()
    {
        /*        $this->user =  Auth::instance("admin")->get_user();
                if (!isset($this->user)){

                }
        */

       Functions::AllRender();
        $this->template = View::factory("admin/" . $this->template);
        $settings = View::factory("admin/settings");
        $pages = Functions::pagesGet();
        $modules = Functions::modulesGet();
        $this->template->title = "Сохранение Сайт";
        $this->template->content = "Содержимое сайта успешно сохранено";
        $this->template->modules =$modules;
        $this->template->url="";
        $this->template->settings = $settings;
        $this->template->pages = $pages;

        echo $this->template;
    }
    public function action_index()
    {
        /*        $this->user =  Auth::instance("admin")->get_user();
                if (!isset($this->user)){

                }
        */
        $this->template = View::factory("admin/" . $this->template);
        $settings = View::factory("admin/settings");
        $pages = Functions::pagesGet();
        $modules = Functions::modulesGet();

        $this->template->modules =$modules;
        $this->template->url="";
        $this->template->settings = $settings;
        $this->template->pages = $pages;

        echo $this->template;
    }
    public function action_modules(){
        $page=$this->request->param('page');
            if($page=="mainmenu"){
                $page = (object)array("bitmask"=>0,"name"=>"Список страниц сайта","url"=>"mainmenu","recursive"=>0);
            }else{
                $page = Functions::moduleGet(array("url"=>$page));
                if($page->bitmask==""){
                    $this->action_index();
                    return;
                }
            }
        $this->template = View::factory("admin/" . $this->template);
        if (file_exists(APPPATH . "views/admin/" . $page->url . "_mod_edit.php")){
            $module_edit = View::factory("admin/" . $page->url . "_mod_edit");
        }else{
            $module_edit = View::factory("admin/module_edit_std");
        }


        $child = Functions::modulesGetContent((0-$page->bitmask),$page->recursive);
        $module_edit->child =$child;
        $module_edit->module= $page;
        $settings = View::factory("admin/settings");
        $pages = Functions::pagesGet();
        $modules = Functions::modulesGet();
        $this->template->content = $module_edit;
        $this->template->modules_cur= $page;
        $this->template->modules =$modules;
        $this->template->url="";
        $this->template->settings = $settings;
        $this->template->pages = $pages;

        echo $this->template;
    }

    public function action_editpage()
    {


        if (isset($_REQUEST["savepage"]) && $_REQUEST["savepage"] == "1"){

            Functions::pageEdit ($_REQUEST, $_REQUEST["page_id"]);
        }
        if (isset($_REQUEST["deleteImg"]) && $_REQUEST["deleteImg"] == "1"){

            Functions::deleteImg ($_REQUEST, $this->request->param('page'));
        }

        /*
                $this->user =  Auth::instance("admin")->get_user();
                if (!$this->user)
                    return;
                if (!isset($this->user)){

                }
        */
       // echo  $this->template;
        $this->template = View::factory("admin/" . $this->template);
        $settings = View::factory("admin/settings");

        $metas = View::factory("admin/metas");
        $page = Functions::pageGetbyId($this->request->param('page'));

        $widjets = View::factory("admin/widjets");

        $pages = Functions::pagesGet();
        $modules = Functions::modulesGet();
        $widjets->modules =$modules;
        $widjets->page = $page;
            switch($page->type){

                case "bloglist":
                    $content = View::factory("admin/file_edit");
                    $content->url= $page->url;
                    break;
                case "uslugi":


                    $content = View::factory("admin/".$page->type."_edit");
                    $content->url= $page->url;

		    $content->uparent = ORM::factory("structure")->where("parent", "=", '-1')->where("on_menu", "=", '1')->find_all();

                    break;
                default:
                    $content = View::factory("admin/".$page->type."_edit");
                    $content->url= $page->url;
                    break;

            }


        $content->modules = $modules;
        $content->page = $page;
        //child section
        $childOrm = Functions::modulesGetContent($page->id,0);

	if($page->type == 'catalog')
	{
	      $child=View::factory("admin/catalog_child");
        }
	else
	{
	      $child=View::factory("admin/child");
	}


	$child->page =$page;

            $child->child =$childOrm;



        $metas->page = $page;


        $this->template->widjets = $widjets;

        $this->template->settings = $settings;
        $this->template->pages = $pages;
        $this->template->page_cur = $page;

        $this->template->modules =$modules;
        $this->template->metas = $metas;
        $this->template->url = $page->url;
        $this->template->content = $content;
        $this->template->child = $child;
        echo $this->template;
    }

    public function action_modal(){
        $action = $this->request->param('page');
        $this->template = View::factory("admin/modals/main");

        switch($action){
            case "new_for_parent":
                $module_edit = View::factory("admin/modals/page_edit_std");
                $obj =Functions::pageGetbyId($this->request->param('param'));
                if(isset($_REQUEST["save"])){
                    if(!isset($_REQUEST["parent"])){
                        $_REQUEST["parent"]= $this->request->param('param');
                    }
                    $obj=Functions::EditModulePage($_REQUEST);

                    $obj =Functions::pageGetbyId($obj->id);
                    $module_edit->obj = $obj;
                }
                if(isset($_REQUEST["el_id"])&&$_REQUEST["el_id"]!=""){
                    $obj =Functions::pageGetbyId($_REQUEST["el_id"]);
                    $module_edit->obj = $obj;
                }

                $new_url = ORM::factory("structure")->count_all();
                $new_url = $new_url+1;
                    
                $module_edit->new_url = $new_url;

                $this->template->page_name = "Добавление в ".$obj->name;
                break;
            case "new_for_module":
                $modulename= $this->request->param('param');
                if($modulename=="mainmenu"){
                    $module = (object)array("bitmask"=>0,"name"=>"Главное меню","url"=>"mainmenu","recursive"=>0);
                }else{
                    $module =Functions::moduleGet(array("url"=>$modulename));
                    if($module->bitmask==""){
                        $this->action_index();
                        return;
                    }
                }

                if (file_exists(APPPATH . "views/admin/modals/" . $module->url . "_edit.php")){
                    $module_edit = View::factory("admin/modals/" . $module->url . "_edit");
                }else{
                    $module_edit = View::factory("admin/modals/module_edit_std");
                }
                if(isset($_REQUEST["save"])){
                    if(!isset($_REQUEST["parent"])){
                        $_REQUEST["parent"]=-$module->bitmask;
                    }
                    $obj=Functions::EditModulePage($_REQUEST);
                   

                    if(isset($_REQUEST["go_edit"]) && $_REQUEST["go_edit"] == '0')
                    {

                    }
                    elseif(isset($_REQUEST["go_edit"]) && $_REQUEST["go_edit"] == '1')
                    {
                        header('location: /uniqbox/editpage/'.$obj->id.'/');
                        exit;
                    }
                    else
                    {
                        $obj =Functions::pageGetbyId($obj->id);
                        $module_edit->obj = $obj;
                    }
                }
                if(isset($_REQUEST["el_id"])&&$_REQUEST["el_id"]!=""){
                    $obj =Functions::pageGetbyId($_REQUEST["el_id"]);
                    $module_edit->obj = $obj;
                }
                
                $new_url = ORM::factory("structure")->count_all();
                $new_url = $new_url+1;
                    
                $module_edit->new_url = $new_url;
                $module_edit->module =$module;
                
                if($module->recursive==1){
                    $module_edit->parents = Functions::modulesGetContentFlat($module->bitmask*-1);
                }
                $this->template->page_name = "Добавление в ".$module->name;
                break;
            case "delete_element":
                Functions::DeleteById($_REQUEST["el_id"]);
                $module_edit="";
                $this->template->page_name = "";
                break;

        }
        $this->template->content =$module_edit;
        echo  $this->template;
    }
    public function action__old_modal (){
        if (isset($_REQUEST["save"]) && $_REQUEST["save"] == "1"){
            if (isset($_REQUEST["doctor_id"])){
                $id = $_REQUEST["doctor_id"];
                if ($id == "-1")
                    $id = "";
                Functions::doctorEdit($_REQUEST, $id);
            } elseif (isset($_REQUEST["facility_id"])){
                $id = $_REQUEST["facility_id"];
                if ($id == "-1")
                    $id = "";
                Functions::facilityEdit($_REQUEST, $id);
            } elseif (isset($_REQUEST["article_id"])){
                $id = $_REQUEST["article_id"];
                if ($id == "-1")
                    $id = "";
                Functions::articleEdit($_REQUEST, $id);
            } elseif (isset($_REQUEST["nw_id"])){
                $id = $_REQUEST["nw_id"];
                if ($id == "-1")
                    $id = "";
                Functions::newsEdit($_REQUEST, $id);
            } elseif (isset($_REQUEST["faq_id"])){
                $id = $_REQUEST["faq_id"];
                if ($id == "-1")
                    $id = "";
                Functions::faqEdit($_REQUEST, $id);
            } elseif (isset($_REQUEST["slide_id"])){
                $id = $_REQUEST["slide_id"];
                if ($id == "-1")
                    $id = "";
                Functions::sliderEdit($_REQUEST, $id);
            } else {
                $id = "";
            }
        }

        if (isset($_REQUEST["del"]) && $_REQUEST["del"] == "1"){
            if (isset($_REQUEST["doctor_id"]))
                Functions::doctorDel($_REQUEST["doctor_id"]);
            if (isset($_REQUEST["facility_id"]))
                Functions::facilityDel($_REQUEST["facility_id"]);
            if (isset($_REQUEST["article_id"]))
                Functions::articleDel($_REQUEST["article_id"]);
            if (isset($_REQUEST["nw_id"]))
                Functions::newsDel($_REQUEST["nw_id"]);
            if (isset($_REQUEST["op_id"]))
                Functions::opinionDel($_REQUEST["op_id"]);
            if (isset($_REQUEST["rec_id"]))
                Functions::recordingDel($_REQUEST["rec_id"]);
            if (isset($_REQUEST["faq_id"]))
                Functions::faqDel($_REQUEST["faq_id"]);
            if (isset($_REQUEST["slide_id"]))
                Functions::sliderDel($_REQUEST["slide_id"]);
            return;
        }

        $page = $this->request->param('page');
        $this->template = View::factory("admin/modals/main");

        $catalog = Functions::catalogGet ();

        if (isset($_REQUEST["doctor_id"]))
            $obj = Functions::doctorGet($_REQUEST["doctor_id"]);
        elseif (isset($_REQUEST["facility_id"]))
            $obj = Functions::catGet(array("id"=>$_REQUEST["facility_id"]));
        elseif (isset($_REQUEST["article_id"]))
            $obj = Functions::pageGet(array("id"=>$_REQUEST["article_id"]));
        elseif (isset($_REQUEST["nw_id"]))
            $obj = Functions::pageGet(array("id"=>$_REQUEST["nw_id"]));
        elseif (isset($_REQUEST["faq_id"]))
            $obj = Functions::faqGet($_REQUEST["faq_id"]);
        elseif (isset($_REQUEST["slide_id"]))
            $obj = Functions::sliderGet($_REQUEST["slide_id"]);
        else
            $obj = "";


        if ($page == "doctor_edit")
            $this->template->page_name = "Редактирование специалиста";
        elseif ($page == "facility_edit")
            $this->template->page_name = "Редактирование услуги";
        elseif ($page == "article_edit")
            $this->template->page_name = "Редактирование статьи";
        elseif ($page == "news_edit")
            $this->template->page_name = "Редактирование новости";
        elseif ($page == "faq_edit")
            $this->template->page_name = "Редактирование вопрос-ответа";
        else
            $this->template->page_name = "Без названия";

        $this->template->content = View::factory("admin/modals/" . $page);

        $this->template->content->obj = $obj;
        $this->template->content->catalog = $catalog;

        echo $this->template;
    }
    public function action_old_editpage()
    {
        if (isset($_REQUEST["savepage"]) && $_REQUEST["savepage"] == "1"){
            Functions::pageEdit ($_REQUEST, $_REQUEST["page_id"]);
        }
        /*
                $this->user =  Auth::instance("admin")->get_user();
                if (!$this->user)
                    return;
                if (!isset($this->user)){

                }
        */
        // echo  $this->template;
        $this->template = View::factory("admin/" . $this->template);
        $settings = View::factory("admin/settings");
        $widjets = View::factory("admin/widjets");
        $metas = View::factory("admin/metas");
        $page = Functions::pageGetbyUrl($this->request->param('page'));

        $banner = Functions::bannerGet(array("parent"=>$page->id, "table"=>"page"));

        if (!isset($page->name)){
            $page = Functions::catGet(array("url" => $this->request->param('page')));
            $url = Functions::GetAllUrl($page->id,"catalog");
        }else{
            $url = Functions::GetAllUrl($page->id,"pages");
        }
        $pages = Functions::pagesGet();
        $modules = Functions::modulesGet();
        $facilities = Functions::catalogGet ("3");
        $articles = Functions::pagesGet ("9");
        $doctors = Functions::doctorsGet();
        $url =array_reverse($url);
        $this->template->url=implode("/",$url);
        if ($page->url == "main"){

            $content = View::factory("admin/edit_main");
            $this->template->nomodule = 1;

        } elseif ($page->url == "nashi-doktora"){

            $content = View::factory("admin/edit_doctors");
            $content->doctors = Functions::doctorsGet();

        } elseif ($page->url == "uslugi"){

            $content = View::factory("admin/edit_facilities");
            $catalog = Functions::catalogGetFull ();
            $content->facilities = $catalog;

        } elseif ($page->url == "ceny-skidki-i-varianty-oplaty"){

            $content = View::factory("admin/edit_price");
            $content->doctors = Functions::doctorsGet();

        } elseif ($page->url == "faq"){

            $content = View::factory("admin/edit_faqs");
            $content->faqs = Functions::faqsGet();
            $this->template->nomodule = 1;

        } elseif ($page->url == "recording"){

            $content = View::factory("admin/edit_recordings");
            $content->recordings = Functions::recordingsGet();
            $this->template->nomodule = 1;

        } elseif ($page->url == "opinions"){

            $content = View::factory("admin/edit_opinions");
            $content->opinions = Functions::opinionsGet(0);
            $this->template->nomodule = 1;

        } elseif ($page->url == "articles"){

            $content = View::factory("admin/edit_articles");
            $content->articles = Functions::articlesGet();
            $this->template->nomodule = 1;

        } elseif ($page->url == "news"){

            $content = View::factory("admin/edit_news");
            $content->news = Functions::newsGet();
            $this->template->nomodule = 1;

        } elseif ($page->url == "mslider"){
            $content = View::factory("admin/edit_mslider");
            $content->sliders = Functions::slidersGet();
            $this->template->nomodule = 1;

        } else {

            if (file_exists(APPPATH . "views/pages/" . $page->url . ".php")){
                $pagecontent = file_get_contents(APPPATH . "views/pages/" . $page->url . ".php");
            } else {
                $pagecontent = "";
            }


            $content = View::factory("admin/editpage");
            $content->pagecontent = $pagecontent;
            $content->url=implode("/",$url);

        }

        $content->modules = $modules;
        $content->page = $page;

        $metas->page = $page;
        $widjets->page = $page;
        $widjets->modules = $modules;

        $this->template->banner = $banner;
        $this->template->doctors = $doctors;
        if (isset($page->doctors) && $page->doctors != "")
            $this->template->doctors_choose = json_decode($page->doctors);
        else
            $this->template->doctors_choose = array();

        $this->template->settings = $settings;
        $this->template->pages = $pages;
        $this->template->page_cur = $page;
        $this->template->facilities = $facilities;
        $this->template->articles = $articles;
        $this->template->widjets = $widjets;
        $this->template->metas = $metas;

        $this->template->content = $content;

        echo $this->template;
    }
}