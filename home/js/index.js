$(function () {
	/* 
        公共页头部和底部开始
    */
	$.ajax({
		type: "post",
		url: "./api/index.php",
		dataType: "json",
		success: function (res) {
			// 解决方案模板
			var solutionTpl = `
            {{each data}}
                <li><a href="solution_detail.php?id={{$value.id}}">{{$value.title}}</a></li>
            {{/each}}
            `;
            // 关于我们模板
            var aboutTpl = `
            <img src="./img/about_us.jpg" alt="" />
            <div class="about-content">
                <p>
                    {{data}}
                </p>
            </div>
            `;
            // 联系我们模板
            var contactTpl = `
            <li>业务经理：<span>{{data.tel}}</span></li>
		    <li>联系邮箱：<span>{{data.email}}</span></li>
            <li>地址：<span	>{{data.address}}</span></li>
            `;
            // 案例中心
            var casesTpl = `
                {{each data}}
                    <a href="cases.php?id={{$value.id}}">
					    <img src="./../../admin/upload/{{$value.img}}" alt="" />
						<span>{{$value.title}}</span>
					</a>
                {{/each}}
            `;
            // 公司新闻案例
            var newsTpl = `
            {{each data}}
                <li><a href="./news_detail.php?id={{$value.id}}">{{$value.title}}</a></li>
            {{/each}}
            `;
            // 行业动态模板
            var industyTpl =`
            {{each data}}
                <li><a href="./news_detail.php?id={{$value.id}}">{{$value.title}}</a></li>
            {{/each}}
            `;
            // 产品知识模板
            var knologyTpl =`
            {{each data}}
                <li><a href="./news_detail.php?id={{$value.id}}">{{$value.title}}</a></li>
            {{/each}}
            `;
			// 模板渲染插入
            var solution = template.render(solutionTpl,{data:res.solution_result.result});
            $('.solution-main').html(solution);
            
            var str = res.about_result.result[0].content.substr(0,190)+'...';
            var about = template.render(aboutTpl,{data:str});
            $('.about-main').html(about);

            var contact = template.render(contactTpl,{data:res.contact_result.result[0]});
            $(".contact-main > ul").html(contact);

            var cases = template.render(casesTpl,{data:res.cases_result.result});
            $('.cases-content').html(cases);

            var news = template.render(newsTpl,{data:res.news_result.result});
            $('.news-content > ul').html(news);

            var industry = template.render(industyTpl,{data:res.indu_result.result});
            $('.industry-content > ul').html(industry);

            var knology = template.render(knologyTpl,{data:res.knol_result.result});
            $('.knology-content > ul').html(knology);
		},
	});
	// 公共头部和底部结束
});
