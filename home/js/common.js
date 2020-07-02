// 点击分页
function changepage(page,sortname) {
    console.log(page)
    $.ajax({
        type:'post',
        url:'./api/cases_list.php',
        data:{
            sortname:sortname,
            page:page
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
                <a href="javascript:;" onclick="changepage({{data.page-1}},'{{sortname}}')"><</a> 
            {{/if}}
                {{each $imports.dispalyPage(data.pages)}}
                    <a href="javascript:;"onclick="changepage({{$value}},'{{sortname}}')">{{$value}}</a>
                {{/each}}
                {{if data.page != data.pages}} 
                <a href="javascript:;" onclick="changepage({{+data.page+1 }},'{{sortname}}')">></a>
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
}

function changedetail(id) {
    $.ajax({
        type:'get',
        url:'./api/cases_detail.php',
        data:{
            id:id
        },
        dataType:'json',
        type
    })
}

// 给以一个数字转换成数组  
function dispalyPage(page) {
    var arr = new Array();
    for(var i=1; i<=page;i++) {
        arr.push(i);
    }
    return arr;
}

// 分页  将页码转换成数组
function dispalyPage(page) {
    var arr = new Array();
    for(var i=1; i<=page;i++) {
        arr.push(i);
    }
    return arr;
}