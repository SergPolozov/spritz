/**
 * Created with JetBrains PhpStorm.
 * User: Иван
 * Date: 06.11.12
 * Time: 16:06
 * To change this template use File | Settings | File Templates.
 */
(function( $ ){


    $.oldajax =  $.ajax;
    $.ajax = function(data){

        if(typeof(data["data"]) =="string"){
            data["data"]+="&url="+url;
        }else{
           data["data"]["url"]=url;
        }
        $.oldajax( data);
    }

})( jQuery );