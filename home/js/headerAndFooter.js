$(function () {
	/* 
        公共页头部和底部开始
    */
	$.ajax({
		type: "post",
		url: "./api/headerAndFooter.php",
		dataType: "json",
		success: function (res) {
			// 头部导航栏模板
			var commentTpl = `
            {{each data}}
                <li>   
					<a href="{{$value.linkname}}.php">
						<p>{{$value.sortname}}</p>
						<span>{{$value.linkname}}</span>
					</a>
					{{set linkname = $value.linkname}}
					<ul class="select-nav" style="display: none;">
						{{each $value.s_title}}
						
                        <li><a href="{{linkname}}.php?sortname={{$value.sortname}}">{{$value.sortname}}</a></li>
                        {{/each }}
					</ul>
                </li>   
            {{/each}}
            `;
			// 底部模板
			var footerTpl = `
            {{each data}}
                <li><a href="{{$value.linkname}}.php">{{$value.sortname}}</a></li>
                <span>|</span>
            {{/each}}
            `;
			
			// 模板渲染插入
			var header = template.render(commentTpl, { data: res.f_title });
            $("#navlist").html(header);

            var footer = template.render(footerTpl, { data: res.f_title });
            $(".footer > .footer-main > .main>ul").html(footer);
            $(".footer > .footer-main > .main>ul>span:last-child").remove();

			// 导航栏事件
			$("#navlist>li").hover(
				function () {
					$(this).children("ul").css({ display: "block" });
					$(this).siblings().children("ul").css({ display: "none" });
				},
				function () {
					$(this).children("ul").css({ display: "none" });
				}
			);
			$("#navlist>li>ul>li").hover(
				function () {
					$(this).css({ background: "#043e80" });
				},
				function () {
					$(this).css({ background: "#0754ac" });
				}
			);
		},
	});
	// 公共头部和底部结束
});
