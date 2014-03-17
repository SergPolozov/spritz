<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 07.11.12
 * Time: 16:39
 * To change this template use File | Settings | File Templates.
 */
class Model_Structure extends ORM
{
    protected $_table_name = 'structure';
    private $_loaded_content_table = array();
    private static  $_table_column_new = array();
    private static  $field_name=array();
    public static $dynamic = array("findestate");
    public function __construct($id=NULL){
        if(count(self::$_table_column_new)==0){
            $result = DB::query(Database::SELECT, 'SHOW FULL COLUMNS FROM '.$this->_table_name)->execute();;
            foreach($result as $elment){
                self::$_table_column_new[]= $elment["Field"];
            }
        }
        parent::__construct($id=NULL);
    }
    public static function check_fieldstat($field,$type){
        if(count(self::$field_name)==0){
            if($type==""){
                return false;
            }else{
                if($type=="file"){
                    $table_name = "file_add";
                }else{
                    $table_name=$type;
                }
                $result = DB::query(Database::SELECT, 'SHOW FULL COLUMNS FROM '.$table_name)->execute();;
                foreach($result as $elment){
                    self::$field_name[]= $elment["Field"];
                }
            }
        }
        return in_array($field,self::$field_name);
    }
    public function check_field($field){
        if(count(self::$field_name)==0){
        if($this->type==""){
            return false;
        }else{
            if($this->type=="file"){

                $table_name = "file_add";
            }else{
                $table_name= $this->type;
            }
            $result = DB::query(Database::SELECT, 'SHOW FULL COLUMNS FROM '.$table_name)->execute();;
            foreach($result as $elment){
                self::$field_name[]= $elment["Field"];
            }
        }
        }
        return in_array($field,self::$field_name);

    }
    public  function __get($name){
        if( $this->has_column($name)){
            return parent::__get($name);
        }
        if(($this->type=="file"||$this->type=="search")&&$name=="content"){
            return $this->contentFile($name);
        }
        if($this->type==""){
            return NULL;
        }
        if(!isset($this->_loaded_content_table[$name])){
            if($this->type=="file"){
                $table_name = "file_add";
            }else{
                $table_name= $this->type;
            }
            $results = DB::select()->from($table_name)->where('id', '=', $this->id)->execute();
            if(isset( $results[0])){
                $this->_loaded_content_table = $results[0];
            }else{
                return NULL;
            }
        }
        return $this->_loaded_content_table[$name];

    }
    public function has_column($column){
        return in_array($column,self::$_table_column_new);

    }
    public function __set($column, $value){

        if( $this->has_column($column)){
            parent::__set($column,$value);
            return;
        }

        if(($this->type=="file"||$this->type=="search")&&$column=="content"){

            $this->setContent($value);
            return;
        }

        if($this->type=="file"){
            $table_name = "file_add";
        }else{
            $table_name= $this->type;
        }
        $results = DB::select()->from($table_name)->where('id', '=', $this->id)->execute();
        if(!isset( $results[0])){
            DB::insert($table_name)->columns(array($column ,"id"))->values(array($value,$this->id))->execute();
        }else{

        DB::update($table_name)->set(array($column =>$value))->where('id', '=',$this->id)->execute();
        }


    }
    public function add_cache($data){
        $this->_loaded_content_table= $data;
    }
    public function contentFile($name="content"){
        if(!isset($this->_loaded_content_table[$name])){
            if(!file_exists(APPPATH . "views/pages/" . $this->url . ".php")){
                $this->_loaded_content_table[$name]="";
            }else{
                $this->_loaded_content_table[$name]= file_get_contents(APPPATH . "views/pages/" . $this->url . ".php");
            }
        }

        return $this->_loaded_content_table[$name];

    }
    public function setContent($data){
        $tar = explode("/",$this->url);
        $str =APPPATH . "views/pages/";
        for($i=0;$i<count($tar)-1;$i++){
            $str.=$tar[$i]."/";
        }
        if(!is_dir($str)){
            mkdir($str,0777,true);
        }
        $file = fopen (APPPATH . "views/pages/" . $this->url . ".php", "w");
        $content =$data;
        fputs($file, $content);
        fclose($file);
        try{
            chmod(APPPATH . "views/pages/" . $this->url . ".php", 0777);
        } catch (Exception $e){

        }


    }
    public function save(Validation $validation = NULL){


       $do_url= in_array("url",$this->_changed);
       $data = parent::save($validation);
        if($do_url){

            $this->do_parent_check();
        }
      /*  $page = ORM::factory("rendered")->where("url","=",$this->url)->find();
        if(!in_array($this->url,self::$dynamic)){
        //$page->content = Controller_Welcome::getHtml($this->url);
        if($page->url==""){
            $page->url =$this->url;
        }
        }

        $page->save();
*/
        return $data;
    }
    public function do_parent_check(){

        $catalog = ORM::factory("structure")->where("parent", "=", $this->id)->find_all();
        foreach($catalog as $element){

            $tar = explode("/",$element->url);
            $newurl =  $this->url."/".$tar[count($tar)-1];
            $element->url =$newurl;
            $element->save();

        }
    }

}