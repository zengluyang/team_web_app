

<style type="text/css">
div.links.row {
    margin-top: 1em;   
}
div.links a{
    margin-right: 4px;
}
div.teacher_info.row {
    margin-bottom: 2.5em;
}
.teacher_info p {
    margin: 0.1em;
    text-indent: 2em;
}

.teacher_info h2{
    font-size: 1.8rem;
}

.teacher_info h3{
    font-size: 1.5rem;
}

.teacher_info {
    background-color: #eee;
    border: 1px solid #999;  
    
    margin-top: 0px; 
    margin-bottom: 20px; 
    padding-bottom: 0px;
    -webkit-box-shadow: 0 6px 10px rgba(0,0,0, .2);
    -moz-box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}
.inline {
    display: inline;
}
</style>

<script>
    $(document).ready(function(){
        $(".more").hide();
        $(".view").click(function(){
            var text = ($(this).text() == "查看") ? "收起" : "查看";
            $(this).siblings(".more").fadeToggle();
            $(this).text(text);
        });
    });
</script>  
<div class="row links">
    <div class="small-2"></div>
    <div class="small-2"></div>
    <div class="small-2"></div>
    <div class="small-2"></div>
    <div class="small-2"></div>
    <a class="button small radius" href="#prof_mao">毛玉明 教授</a>
    <a class="button small radius" href="#prof_leng">冷甦鹏 教授</a>
    <a class="button small radius" href="#prof_ma">马立香 副教授</a>
    <a class="button small radius" href="#prof_jiang">蒋体钢 副教授</a>
    <a class="button small radius" href="#prof_li">李龙江 副教授</a>

</div>
<div id="prof_mao" class="row teacher_info radius">
    <div class="medium-3 columns">
        <img src="<?php echo Yii::app()->baseUrl.'/images/'?>prof_mao.jpg"/>
    </div>
    <div class="medium-9 columns end">
        <h2><strong>毛玉明 教授</strong></h2>
        <h3>个人简历</h3>
        <p>1977年～1982年，电子科技大学通信专业、本科</p>
        <p>1982年～1984年，电子科技大学信息传输与处理专业，硕士</p>
        <p>1984年～1992年，电子科技大学通信与信息工程学院，助教讲师</p>
        <p>1992年～1999年，电子科技大学通信与信息工程学院，副教授</p>
        <p>1999年起，电子科技大学通信与信息工程学院，教授，博士生导师(2002年起)</p>
        <h3 class="inline">主要学术成绩</h3>
        <span class="view button small right radius">查看</span>
        <div class="more">
            <p>在七五预研项目PENET分组交换实验网中，提出网络管理控制模型，自主设计网络控制协议，在国内第一个成功研制出分组网网控中心系统； 获电子部科技进步一等奖和国家科技进步二等奖。</p>
            <p>军用分组无线网预研项目的创始人之一。在低速分组无线网、高速分组无线网、分组无线网应用系统项目中，对无线网络协议体系、无线信道访问协议、无线网管理技术、系统软件架构设计、系统应用等多方面做出突出贡献，获部级二、三等奖多次；提出IP路由高速转发技术，并成功研制成功我国第一台基于PC的高性能局域网路由器；获教育部科学技术一等奖一项。</p>
 <p>主持国家863无线移动自组织互联网重点项目，在国内首次提出并实现了具有无线mesh网结构的无线移动自组织互联网实验系统。提出了多级分层的无线自组织网络互联结构，并在超短波指挥调度系统中获得成功示范应用。</p>
 <p>荣获国防科工委“光华科技基金个人二等奖”、“国务院政府特殊津贴”、国家“百千万人才工程”国家级入选。</p>

        </div>
    </div>
</div>
    
<div id="prof_leng" class="row teacher_info radius">
    <div class="medium-3 columns">
        <img src="<?php echo Yii::app()->baseUrl.'/images/'?>prof_leng.jpg"/>
    </div>
    <div class="medium-9 columns end">
        <h2><strong>冷甦鹏 教授</strong></h2>
        <h3>个人简历</h3>
        <p><strong>博士</strong>，<strong>教授</strong>，<strong>博士生导师</strong>，教育部“新世纪优秀人才支持计划”入选者，现于电子科技大学通信与信息工程学院从事科研和教学工作。研究领域包括无线自组织网、物联网/无线传感网、认知无线电网络、下一代宽带无线网络、无线移动互联网、智能交通技术等。曾在信息产业部第二十八研究所从事电子设备的设计开发工作，担任项目主持设计师，获江苏省科技进步二等奖一项。后于新加坡南洋理工大学（Nanyang Technological University）电子与电机工程学院从事无线自组织网络技术研究，获博士学位。毕业后于南洋理工大学网络技术研究中心从事下一代无线网络研究，任研究员。2005年9月作为引进人才任职于电子科技大学。2008年作为访问教授（Visiting Professor）对美国奥克兰大学（Oakland University）进行了学术访问与科研项目合作，并与挪威Simula国家研究实验室建立了长期的学术合作关系。</p>
        <h3 class="inline">主要学术成绩</h3>
        <span class="view button small right radius">查看</span>
        <div class="more">
            <p>目前为IEEE Commun. Society与Vehicular Technology Society 会员， International Journal of Ultra Wideband Commun. and Systems（Inderscience）编委，IEEE Commun. Magazine, IEEE Trans. on Wireless Commun.、IEEE Wireless Commun. Magazine、Computer Commun.(Elsevier), Computer Networks (Elsevier)、电子学报、通信学报等国内外10余家学术期刊审稿专家，GLOBECOM 2008～2010等10余个国际会议TPC Member，并为CHINACOM 2010 workshop 主席、IEEE ICCT 2011 Commun. Theory分会共同主席，科技部国际科技合作同行专家、国家863 科技项目申报同行专家。在国内外学术期刊及会议上发表了50余篇通信领域的高质量论文，其中SCI收录7篇，EI收录29篇，出版英文专著1部，并申请专利4项。作为课题负责人或主研人员参与了国家自然基金项目2项、国家863项目课题2项、国家科技重大专项项目课题4项、国家科技支撑项目1项、部级基金项目3项，校企合作项目多项。</p>
        </div>
    </div>
</div>

<div id="prof_ma" class="row teacher_info radius">
    <div class="medium-3 columns">
        <img src="<?php echo Yii::app()->baseUrl.'/images/'?>prof_ma.jpg"/>
    </div>
    <div class="medium-9 columns end">
        <h2><strong>马立香 副教授</strong></h2>
        <h3>个人简历</h3>
        <p>1984年7月重庆大学计算机及自动化系本科毕业；1984.7至1986.9,信产部711厂从事技术情报工作；1986.10至2001.6,信产部789厂从事军事通信网络的研制工作，其间参加多个国家级炮兵通信系统的研制，受聘高级工程师，通信主任设计师；2001年调入电子科技大学至今，受聘副教授，从事计算机网络及网络工程相关的教学与科研工作。</p>
        <h3 class="inline">主要研究方向</h3>
        <span class="view button small right">查看</span>
        <div class="more">
            <p>数据通信与计算机网络、无线自组织网络、无线传感器网络、宽带无线网络和物联网技术。</p>
            <h3>主要学术成绩</h3>
            <p>参与编写出版教材2部，在国内期刊和国际会议上发表论文十余篇，其中EI收录3篇。曾获“重庆市劳动模范”称号，电子科大 “优秀主讲教师”。近几年参加国家863高科技2项，科技部重大专项科研项目2项。</p>
        </div>
    </div>
</div>
    
    

<div id="prof_jiang" class="row teacher_info radius">
    <div class="medium-3 columns">
        <img src="<?php echo Yii::app()->baseUrl.'/images/'?>prof_jiang.jpg"/>
    </div>
    <div class="medium-9 columns end">
        <h2><strong>蒋体钢 副教授</strong></h2>
        <h3>个人简历</h3>
        <p>2001年～2005年，西南交通大学，计算机与通信工程学院，获工学博士学位</p>
        <p>2004年～2005年，香港城市大学，计算机科学系，助理研究员</p>
        <p>2005年～2007年，电子科技大学，通信与信息工程学院，博士后研究</p>
        <p>2008年～至今，电子科技大学，副教授</p>
        <h3 class="inline">主要学术成绩</h3>
        <span class="view button small right radius">查看</span>
        <div class="more">
            <p>主要研究方向为无线网络协议与算法，多媒体通信。近年来在以上领域发表论文30余篇，申请专利3项，软件著作权1项。目前正主持国家自然科学基金“认知用户多信道传输资源分配策略研究”1项，作为主研参与1项国家863重点项目和1项国家自然基金重点项目</p>
        </div>
    </div>
</div>
    
    
    
<div id="prof_li" class="row teacher_info radius">
    <div class="medium-3 columns">
        <img src="<?php echo Yii::app()->baseUrl.'/images/'?>prof_li.jpg"/>
    </div>
    <div class="medium-9 columns end">
        <h2><strong>李龙江 副教授</strong></h2>
        <h3>个人简历</h3>
        <p>1998年7月，本科毕业于西安邮电学院，获得计算机科学与技术专业学士学位</p>
        <p>2001年4月，硕士毕业于西安电子科技大学，获得计算机科学与技术专业硕士学位</p>
        <p>2001年4月至2003年8月，于中兴通讯股份有限公司南京研究所，担任软件研发工程师</p>
        <p>2007年10月，于上海交通大学电子与电气工程学院，获得计算机科学与技术专业博士学位</p>
        <p>2007年10月至今， 于电子科技大学通信与信息工程学院，从事教学与科研工作</p>
        <h3 class="inline">主要学术成绩</h3>
        <span class="view button small right radius">查看</span>
        <div class="more">
            <p>研究领域包括无线自组织网/传感器网络、宽带无线网络、移动互联网、三维可视化、物联网技术等。</p>
            <p>已发表10余篇通信网络领域的高质量论文, 第一作者EI收录论文9篇，其中SCI收录7篇，并申请该领域相关的专利3项。曾担任国际会议ChinaCom2010、IEEE ICCT '11（ICCT 2011 : IEEE 13th International Conference on Communication Technology）国际会议TPC Member，《IEEE GLOBECOM 2008 》《European Wireless conference2009 》与国际期刊《Wireless Personal Communications》《Wiley::Wireless Communications &amp; Mobile Computing》《Journal of Network and Computer Applications》等审稿专家。目前主持校企合作项目2项，并参与1项国家科技重大专项项目及2项自然基金项目。</p>
        </div>
    </div>
</div>    