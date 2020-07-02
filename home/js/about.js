$(function() {
    $.ajax({
        type:'post',
        url: "./api/about.php",
        dataType:"json",
        success:function(res) {
            var aboutus_titleTpl = `
            {{each data}}
            <li><a href="javascript:;" value="{{$value.sortname}}">{{$value.sortname}}</a></li>
            {{/each}}
            `;
            var aboutus = template.render(aboutus_titleTpl,{data:res.result});
            $('#aboutus_title').html(aboutus);
        }
    });

    var sear = getSearch();
    console.log(sear);
    $.ajax({
        type:'post',
        url:'./api/about_detail.php',
        data:sear,
        dataType:'json',
        success:function(res) {
            console.log(res);
            var aboutus_contentTpl = `
            <div class="right-title">
			<h4>{{data.sortname}}</h4>
			<p>您的位置：<a href="index.php">首页</a>>{{data.sortname}}</p>
		    </div>
		    <div class="right-main">
			<img src="./img/2.jpg" alt="">
			<p>{{data.content}}</p>
		</div>
            `;
            var about_content = template.render(aboutus_contentTpl,{data:res.data[0]});
            $('#aboutus_content').html(about_content);
        },
        error:function(err) {
            console.log(err)
        }
    });
    $("#aboutus_title").on('click','li',function() {
        var sortname = $(this).children('a').html();
        $(this).css({'background':'#0756b0'}).siblings().css({'background':'#f5f5f5'});
        $.ajax({
            type:'post',
            url:'./api/about_detail.php',
            data:{
                sortname:sortname
            },
            dataType:'json',
            success:function(res) {
                console.log(res);
                var aboutus_contentTpl = `
                <div class="right-title">
                <h4>{{data.sortname}}</h4>
                <p>您的位置：<a href="index.php">首页</a>>{{data.sortname}}</p>
                </div>
                <div class="right-main">
                <img src="./img/2.jpg" alt="">
                <p>{{data.content}}</p>
            </div>
                `;
                var about_content = template.render(aboutus_contentTpl,{data:res.data[0]});
                $('#aboutus_content').html(about_content);
            },
            error:function(err) {
                console.log(err)
            }
        });
    })
})