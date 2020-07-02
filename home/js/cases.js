$(function() {
    // 请求标题
    $.ajax({
        type:'post',
        url: "./api/cases_title.php",
        dataType:"json",
        success:function(res) {
            var cases_titleTpl = `
            {{each data}}
            <li><a href="javascript:;" value="{{$value.sortname}}">{{$value.sortname}}</a></li>
            {{/each}}
            `;
            var cases = template.render(cases_titleTpl,{data:res.result});
            $('#cases_title').html(cases);
        },
        error:function(err) {
            console.log(err)
        }
    });

    // 加载全部
    $.ajax({
        type:'post',
        url:'./api/cases_list.php',
        dataType:'json',
        success:function(res) {
            console.log(res);
            var cases_listTpl = `
            <ul id="list">
            {{each data.result}}
				<li>
					<a href="#"><a href="javascript:;" onclick="changedetail({{$value.id}})">
						<img src="./../../admin/upload/{{$value.img}}" alt="">
						<span>{{$value.title}}</span>
					</a>
                </li>
            {{/each}}
			</ul>
            <ul id="pagenation">
                {{if data.page != 1}} 
                    <a href="javascript:;" onclick="changepage({{data.page}})"><</a> 
                {{/if}}
                {{if data.pages > 1}}
                    {{each $imports.dispalyPage(data.pages)}}
                        <a href="javascript:;"onclick="changepage({{$value}})">{{$value}}</a>
                    {{/each}}
                {{/if}}
                {{if data.page != data.pages}} 
                    <a href="javascript:;" onclick="changepage({{data.page+1 }})">></a>
                {{/if}}
			</ul>
            `;
            /* 
                在模板中调用外来方法  需要先声明导入方法
            */
            template.defaults.imports.dispalyPage = dispalyPage;
            var cases_list= template.render(cases_listTpl,{data:res.data});

            $('#cases_list').html(cases_list);
        },
        error:function(err) {
            console.log(err)
        }
    });

    $("#cases_title").on('click','li',function() {
        var sortname = $(this).children('a').html();
        $(this).css({'background':'#0756b0'}).siblings().css({'background':'#f5f5f5'});
        var right_titleTpl = `
            <h4>{{data}}</h4>
            <p>您的位置：<a href="index.php">首页</a>>{{data}}</p>
        `;
        var cases_title = template.render(right_titleTpl,{data:sortname});
        $('#cases_right_title').html(cases_title);
        $.ajax({
            type:'post',
            url:'./api/cases_list.php',
            data:{
                sortname:sortname
            },
            dataType:'json',
            success:function(res) {
                console.log(res);
                var cases_listTpl = `
                <ul id="list">
                {{each data.result}}
                    <li>
                        <a href="javascript:; onclick="changedetail({{$value.id}})">
                            <img src="./../../admin/upload/{{$value.img}}" alt="">
                            <span>{{$value.title}}</span>
                        </a>
                    </li>
                {{/each}}
                </ul>
                <ul id="pagenation">
                {{if data.page != 1}} 
                <a href="javascript:;" onclick="changepage({{data.page}})"><</a> 
                    {{/if}}
                    {{each $imports.dispalyPage(data.pages)}}
                        <a href="javascript:;"onclick="changepage({{$value}},'{{sortname}}')">{{$value}}</a>
                    {{/each}}
                    {{if data.page != data.pages}} 
                    <a href="javascript:;" onclick="changepage({{data.page+1 }})">></a>
                {{/if}}
                    
                </ul>
                `;
                /* 
                    在模板中调用外来方法  需要先声明导入方法
                */
                template.defaults.imports.dispalyPage = dispalyPage;
                var cases_list= template.render(cases_listTpl,{data:res.data,sortname:sortname});
    
                $('#cases_list').html(cases_list);
            },
            error:function(err) {
                console.log(err)
            }
        });
    })
   
    
})
