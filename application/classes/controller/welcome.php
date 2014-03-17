<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {
    public $template = "maintemplate";
    public $params = Array();
    public $user;

    public function isdynamic(){
        return in_array($this->request->param('page'),Model_Structure::$dynamic)||
            in_array($this->request->param('secondmenu'),Model_Structure::$dynamic)||
            in_array($this->request->param('submenu'),Model_Structure::$dynamic);
	    in_array($this->request->param('thmenu'),Model_Structure::$dynamic);
	    in_array($this->request->param('fmenu'),Model_Structure::$dynamic);
	    in_array($this->request->param('fimenu'),Model_Structure::$dynamic);


    }
    public function action_index(){

        $page= $this->request->param('page');
        $secondmenu = $this->request->param('secondmenu');
        $submenu = $this->request->param('submenu');
	$thmenu = $this->request->param('thmenu');
	$fmenu = $this->request->param('fmenu');
	$fimenu = $this->request->param('fimenu');
  
        $url = $page;
        // если этот параметр true  страница шрузитсЯ динма
        $isdynamic=$this->isdynamic();;

        if (isset($secondmenu)){

            $url .="/".$secondmenu;
        }
        if (isset($submenu)){

            $url .="/".$submenu;
        }
        if (isset($thmenu)){

            $url .="/".$thmenu;
        }
        if (isset($fmenu)){

            $url .="/".$fmenu;
        }
        if (isset($fimenu)){

            $url .="/".$fimenu;
        }
        $page = ORM::factory("rendered")->where("url","=",$url)->find();
        if($page->id==""){
            echo $this->getHtml($url);
        }
        //  echo $page->content;

    }
    public  static function  getHtml($urlOrm){

        $template = "maintemplate";
        $template = View::factory($template);
        $tar = explode("/",$urlOrm);

        $pagePar= $tar[0];

        if(isset($tar[1])){
            $secondmenu = $tar[1];
        }
        if(isset($tar[2])){
            $submenu =$tar[2];
        }
        if(isset($tar[3])){
            $thmenu =$tar[3];
        }
        if(isset($tar[4])){
            $fmenu =$tar[4];
        }
        if(isset($tar[5])){
            $fimenu =$tar[5];
        }
        // Если у нас не перваЯ страница в адресе например /catalog/tovar1/
        // то для вьюхи стоит проверять и вьюху родителя т.е. не только /catalog/tovar1.php
        // но и просто /catalog.php

        $maybe_parent =false;
        $url = $pagePar;
        if (isset($secondmenu)){
            $maybe_parent=true;
            $url .="/".$secondmenu;
        }
        if (isset($submenu)){
            $maybe_parent=true;
            $url .="/".$submenu;
        }
        if (isset($thmenu)){
            $maybe_parent=true;
            $url .="/".$thmenu;
        }
        if (isset($fmenu)){
            $maybe_parent=true;
            $url .="/".$fmenu;
        }
        if (isset($fimenu)){
            $maybe_parent=true;
            $url .="/".$fimenu;
        }
        
        
//         if($pagePar=="catalog"&&!$maybe_parent){
//             $pagePar="catalog";
//             $url = $pagePar;
//         }
        $page = Functions::pageGet(array("url"=>$url));
        if(!isset($page->name)){
            $page = Functions::pageGet(array("url"=>"404"));

        }

        $get_main_menu= Functions::GetMainMenuTech(0);
        $mainmenu = View::factory("mainmenu");
        $mainmenu->menu = $get_main_menu;
        $mainmenu->page = $url;

        if (file_exists(APPPATH . "views/" . $url . "_page.php")){


             $center = View::factory( $url."_page");
         } elseif($maybe_parent&&file_exists(APPPATH . "views/" . $pagePar. ".php")){
             $center = View::factory( $pagePar);
         }else {
            $center = View::factory( "simplepage");

        }

        $center->mainmenu =$mainmenu;

        $center->page =$page->url;
        $user =Auth::instance()->get_user();
        $center->user = $user!=false?$user->username:0;
        //content section

        if(($maybe_parent&&file_exists(APPPATH . "views/" . $pagePar. ".php"))||file_exists(APPPATH . "views/" . $url . ".php")){
            if (file_exists(APPPATH . "views/" . $url . ".php")){


                $content = View::factory( $url);
            }
            if($maybe_parent&&file_exists(APPPATH . "views/" . $pagePar. ".php")){
                $content = View::factory( $pagePar);
            }


            switch($pagePar){

                case "favorite":
                    $content->user = Auth::instance()->get_user();
                    break;
            }

        }else{
            switch($page->type){
                case "search":
                    $list =Functions::modulesSearch($page->content,$_REQUEST["query"],Isset($_REQUEST["page"])?$_REQUEST["page"]:1);
                    $content= View::factory("searchresult");
                    $content->list= $list;
                    $content->page =$page;
                    break;

                case "news":

                    $content= View::factory("one_new");

                    $content->page =$page;
                    break;
                case "specialist":

                    $content= View::factory("one_specialist");

                    $content->page =$page;
                    break;
                case "articles":

                    $content= View::factory("one_articles");

                    $content->page =$page;
                    break;
                case "catalog":

                    $content= View::factory("one_catalog");

                    $list = Functions::modules_get_table($page->id);
                    
                    $select = ORM::factory("structure")->where("parent","=",$page->id)->find_all();
                    $childs = array();
                    
                    foreach($select as $value)
                    {
                        $childs[] = $value->id;
                    }
                    
                    $new_array = $childs;
                    
                    $type = 1;
                    
                    while($type != 0)
                    {
                        $type = 1;

                        if(count($childs) > 0)
                        {
                            $pcount = ORM::factory("structure")->where("parent","in",$childs)->count_all();

                            if($pcount != 0)
                            {
                                $porm = ORM::factory("structure")->where("parent","in",$childs)->find_all();
                                
                                $childs = array();
                                
                                foreach($porm as $value)
                                {
                                    $childs[] = $value->id;
                                }
                                
                                $new_array = array_merge($new_array, $childs);;
                                
                            }
                            else
                            {
                                $type = 0;
                            }
                        
                        }
                        else
                        {
                            $type = 0;
                        }

                    }
                    
                    $all_childs = array();
                    if(count($new_array) > 0)
                    {
                        $all_childs = ORM::factory("structure")->where("id","in",$new_array)->order_by('order','asc')->find_all();
                    }
                    $content->all_childs = $all_childs;
                    $content->list = $list;


                    if($page->type_content == 0)
                    {
                        $menu = ORM::factory("structure")->where("id","=",$page->parent)->find();
                        $menu = ORM::factory("structure")->where("parent","=",$menu->parent)->order_by('order','asc')->find_all();
                    }
                    else
                    {
                        $menu = ORM::factory("structure")->where("parent","=",$page->parent)->order_by('order','asc')->find_all();
                    }
                    
                    $favorite = ORM::factory("catalog")->where("type_content","=",0)->where("on_top","=",1)->find_all();
                    $fids = array();
                    
                    foreach($favorite as $value)
                    {
                        $fids[] = $value->id;
                    }
                    
                    if(count($fids) != 0)
                    {
                        $sfavorite = ORM::factory("structure")->where("id","in",$fids)->order_by('order','asc')->find_all();                    
                        $content->sfavorite = $sfavorite;
                    }
                        
                    $content->menu_parent = $menu;
                    
                    $explode = explode('/',$page->url);
                    
                    $urls = array();
                    $big_url = '';
                                        
                    foreach($explode as $value)
                    {
                    
                        if($big_url == '')
                        {
                          $big_url  = $value;
                        }
                        else
                        {
                          $big_url = $big_url.'/'.$value;
                        }
                        
                        $urls[] = $big_url;
                    }
                    
                    $orm =  ORM::factory("structure")->where("url","in",$urls)->find_all();

                    $content->page =$page;
                    $content->urls =$orm;
                    break;
                case "file":
                    if (file_exists(APPPATH . "views/pages/" . $url . ".php")){
                        $content = View::factory("pages/" . $url);
                    } else {
                        $content = View::factory("pages/default");
                    }
                    break;


            }
        }
        //$content->favoriteids= Functions::returnBasketId();
        

        
        switch($page->url){
            case "main":

                $news = Functions::modules_get_table('-4','3');
                $center->news =$news;


                break;
            case "news":

                break;

        }

	if($tar[0] == 'catalog')
	{

	    $url_search = $tar[1];

	    $jjj = 0;

	    $catalog_count = 0;
	    $page_r = 0;
	    $per_page = 0;

	    if(isset($tar[2]))
	    {
		$catalog = ORM::factory("catalog")->where('id','=',$tar[2])->order_by('timestamp','desc')->find();

		$catalogtype = ORM::factory("catalogtype")->where('id','=',$catalog->catalog)->find();

		$jjj = 1;
	    }
	    else
	    {
		$per_page= Functions::get_per_page();
		if (isset($_GET['page'])) $page_r=($_GET['page']-1); else $page_r=0;
		$start=abs($page_r*$per_page);

		$catalogtype = ORM::factory("catalogtype")->where('url','=',$url_search)->find();

		$catalog_count = ORM::factory("catalog")->where('catalog','=',$catalogtype->id)->order_by('timestamp','desc')->count_all();
		$catalog = ORM::factory("catalog")->where('catalog','=',$catalogtype->id)->offset($start)->limit($per_page)->order_by('timestamp','desc')->find_all();
	    }

	    $content = View::factory("one_catalog");
	    $content->catalog = $catalog;
	    $content->catalog_count = $catalog_count;
	    $content->page_r = $page_r;
	    $content->per_page = $per_page;
	    $content->catalogtype = $catalogtype;
	    $content->page_url = $urlOrm;
	    $content->jjj = $jjj;
	}

        $modules = Functions::modulesGet();
        // echo $page->modules;
        foreach($modules as $element){

            if((int)$page->modules & (int)$element->bitmask){
                $module = View::factory("widjets/".$element->url);

                $list =Functions::modulesGetContent( (-1)*$element->bitmask,$element->recursive);

                $module->list = $list;
                $module->page = $page->url;

                switch($element->place){
                    case 0:
                        $content.= $module->render();
                        break;
                    case 1:
                        $content = $module->render().$content->render();
                        break;
                    case 2:
                        $content->{ $element->url} =$module;
                        break;
                    case 3:
                        $template->{ $element->url} =$module;

                        break;
                    case 4:
                        $content->list =$module;
                        break;
                    case 5:
                        //$center->simple_content = $module;
                        break;
                    case 6:
                        $content->list =$module;
    
                        break;
                    case 10:
                    
                        $favorite = ORM::factory("catalog")->where("type_content","=",0)->where("on_top","=",1)->find_all();
                        $fids = array();
                        
                        foreach($favorite as $value)
                        {
                            $fids[] = $value->id;
                        }
                        
                        if(count($fids) != 0)
                        {
                            $sfavorite = ORM::factory("structure")->where("id","in",$fids)->order_by('order','asc')->find_all();                    
                            $module->sfavorite = $sfavorite;
                        }
                    
                        $content->list =$module;
    
                        break;
                        
                }
            }
        }

	if(isset($page)) $center->page = $page;
        $center->content = $content;
	$center->get_main_menu = $get_main_menu;


        $template->center =$center;
        //Top Section
        $top = View::factory("top");

        $top->meta_title=$page->meta_title;
        $top->meta_key=$page->meta_key;
        $top->meta_descr=$page->meta_descr;
        $top->region=Functions::ReturnRegionForJS();
        //Bottom Section
        
        $feedscount = ORM::factory("structure")->where("parent","=",'-16')->where("on_menu","=",'1')->count_all();
        
       // echo $rand_row;
        
        $bottom =View::factory("bottom");
        //$bottom->mainmenu = str_replace('id="menu"','', $mainmenu);
        //$bottom->contacts = Functions::get_footer_contacts();
  
        
        /*if($feedscount > 0)
        {
            $rand_row = rand(0,$feedscount-1);
            $feed = ORM::factory("structure")->where("parent","=",'-16')->where("on_menu","=",'1')->limit(1)->offset($rand_row)->find();
            $bottom->feed = $feed;
            
        }*/
        
        
        $template->top =$top;
        $template->bottom =$bottom;
        
        return  $template;
    }
    public function action_old_index()
    {
        $actions = 0;
        $catalog = array();

        $articles = Functions::articlesGet();
        $modules = Functions::modulesGet();
        $doctors = Functions::doctorsGet();
        $doctors_marked = Functions::doctorsGetMarked();

        $this->user=  Auth::instance("site")->get_user();
        $secondmenu = $this->request->param('secondmenu');
        $submenu = $this->request->param('submenu');

        $page = Functions::pageGet(array("url"=>$this->request->param('page')));
        $pages = Functions::pagesGet();
        foreach ($pages as $page_temp){
            if ($page_temp->type == "2"){
                $catalog[$page_temp->id] = Functions::catalogGet ($page_temp->id);
                $facilities = $catalog[$page_temp->id];
                foreach ($catalog[$page_temp->id] as $cat){
                    if ($cat->child == 1){
                        $catalog[$cat->id] = Functions::catalogGet ($cat->id, 1);
                    }
                }
            }
        }

        $url = $page->url;
        if (isset($secondmenu))
            $url = $secondmenu;
        if (isset($submenu))
            $url = $submenu;

        if ($url != $page->url){
            if ($page->type == "2")
                $curpage = Functions::catGet(array("url"=>$url));
            $actions = 1;
        } else {
            $curpage = $page;
            $actions = 0;
        }

        if (file_exists(APPPATH . "views/pages/" . $url . ".php")){
            $content = View::factory("pages/" . $url);
        } else {
            $content = View::factory("pages/default");
        }
        $pagetop = View::factory("pages/pageTop");
        $pagebottom = View::factory("pages/pageBottom");

        $pagetop->page = $curpage;
        if ($actions)
            $pagetop->actions = 1;
        else
            $pagetop->actions = 0;

        if (!isset($curpage->type) && isset($curpage->child) && $curpage->child == 1){
            $subpage = Functions::catalogGet ($curpage->id);
            $pagetop->subpage = $subpage;
        }

        $top = View::factory("top");

        $banner = Functions::bannerGet(array("parent"=>$curpage->id, "table"=>"page"));

        $this->template = View::factory($this->template);
        switch ($page->type){
            case "0":
                $news = Functions::newsGet("3");
                $aboutsmall = Functions::pageGet(array("id" => "27"));
                $opinions = Functions::opinionsGet();
                if (file_exists(APPPATH . "views/pages/" . $aboutsmall->url . ".php")){
                    $aboutsmall = View::factory("pages/" . $aboutsmall->url);
                } else {
                    $aboutsmall = View::factory("pages/default");
                }
                $this->template->center = View::factory("mainpage");
                $this->template->center->news = $news;
                $this->template->center->aboutsmall = $aboutsmall;
                $this->template->center->opinions = $opinions;
                $slider = View::factory("includes/slider");
                $sliders = Functions::slidersGet();
                $slider->sliders = $sliders;
                break;
            case "1":
                $this->template->center = View::factory("simplepage");
                $slider = View::factory("includes/slidersimple");
                $sidebar = View::factory("includes/sidebar");
                $sidebar->submenu = $facilities;
                $sidebar->page = $url;
                if (isset($secondmenu)){
                    $p_s = Functions::catGet(array("url" => $secondmenu));
                    $sidebar->page_second = $p_s;
                }
                if (isset($submenu)){
                    $p_t = Functions::catGet(array("url" => $submenu));
                    $sidebar->page_third = $p_t;
                }

                $sidebar->catalog = $catalog;
                break;
            case "2":
                $this->template->center = View::factory("simplepage");
                $slider = View::factory("includes/slidersimple");
                $sidebar = View::factory("includes/sidebar");
                $sidebar->submenu = $facilities;
                $sidebar->page = $url;
                if (isset($secondmenu)){
                    $p_s = Functions::catGet(array("url" => $secondmenu));
                    $sidebar->page_second = $p_s;
                }
                if (isset($submenu)){
                    $p_t = Functions::catGet(array("url" => $submenu));
                    $sidebar->page_third = $p_t;
                }
                $sidebar->catalog = $catalog;

                $content->page = $page;
                $content->catalog = $catalog;
                break;
        }

        $slider->page = $page;
        $slider->banner = $banner;

        $top->pageCur = $page->url;
        $top->pages = $pages;
        $top->slider = $slider;
        $top->catalog = $catalog;
        $top->secondmenu = $secondmenu;
        $top->submenu = $submenu;
        $top->page = $page;

        $content->doctors = $doctors;

        $this->template->center->modules = array();
        foreach ($modules as $module){
            if ($curpage->modules & $module->bitmask && $module->place == 0){
                $mod = View::factory("widjets/" . $module->url);
                if ($module->bitmask == "1")
                    $mod->doctors_marked = $doctors_marked;
                $this->template->center->modules[] = $mod;
            }
        }

        $bottom = "";

        if (isset($sidebar)){
            $this->template->center->sidebar = $sidebar;
            $this->template->center->sidebar->modules = array();
            foreach ($modules as $module){
                if ($curpage->modules & $module->bitmask && $module->place == 1){
                    $mod = View::factory("widjets/" . $module->url);
                    if ($module->bitmask == "1")
                        $mod->doctors_marked = $doctors_marked;
                    $this->template->center->sidebar->modules[] = $mod;
                }
            }
        }

        $this->template->top = $top;
        $this->template->center->pagetop = $pagetop;
        $this->template->center->content = $content;
        $this->template->center->articles = $articles;
        if (isset($facilities))
            $this->template->center->facilities = $facilities;

        if ($page->url == "ceny-skidki-i-varianty-oplaty") {
            $this->template->center->content = View::factory("includes/ceny-skidki-i-varianty-oplaty");
            $price = Functions::priceGet();
            $this->template->center->content->price = $price;
            foreach ($price as $p){
                $elp = ORM::factory("price");
                $elp->name = $p["name"];
                $elp->value = $p["value"];
                $elp->cat = $p["cat"];
                $elp->save();
            }
        }

        $this->template->center->pagebottom = $pagebottom;
        $this->template->bottom = $bottom;

        echo $this->template;
    }

} // End Welcome
