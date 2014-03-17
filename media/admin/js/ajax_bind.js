/**
 * Created with JetBrains PhpStorm.
 * User: Sergey
 * Date: 28.10.12
 * Time: 15:05
 * To change this template use File | Settings | File Templates.
 */
(function($){
    $.fn.ajax_bind = function(opts){
        $(this).unbind('click').bind('click', function(){
            if (confirm("Вы уверены?")){
                url = $(this).attr('href');
                answer = $(this).attr('answer');
                action = $(this).attr('action');
                $.post(url, {}, function(){
                    if (answer.length)
                        alert (answer);
                    if (action.length)
                        document.location = action;
                });
            }
            return false;
        });
    }
})(jQuery);