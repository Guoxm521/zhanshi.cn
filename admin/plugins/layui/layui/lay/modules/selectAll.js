layui.define('jquery',function(exports){ 
    $=layui.jquery;
  var obj = {
    hello: function(str){
      alert('Hello '+ (str||'selectAll'));
    },
    select:function() {
        $('#selectAll').on('click', function() {
            var flag = $(this).prop('checked');
            $('.selectone').prop('checked', flag)
        })
    }
  };
  
  exports('selectAll', obj);
});