
<div class="tabbable tabs-left" style="min-height: 400px;">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#lA"><i class="icon-search  icon-3x"></i>  万能搜索</a></li>

        <li class=""><a data-toggle="tab" href="#lC"><i class="icon-github  icon-3x"></i>  git教程</a></li>
        <li class=""><a data-toggle="tab" href="#lB"><i class="   icon-comments  icon-3x"></i>  有事留言</a></li>
        <li class=""><a data-toggle="tab" href="#lD"><i class=" icon-h-sign  icon-3x"></i>  批量运行</a></li>
        <li class=""><a data-toggle="tab" href="#lE"><i class="icon-spinner icon-spin icon-3x"></i>  再加点啥</a></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="tab-content">
        <div id="lA" class="tab-pane active" style="min-height: 420px; overflow: hidden;">
            <div class="container">
                <div class="row" style="min-height: 420px; overflow: hidden;">
                    <div class="span3">
                    </div>
                    <div class="span6">
                        <h1 style="min-height: 100px;" class="text-center"><img src="../assets/img/search-logo.jpg"></h1>
                        <div class="input-append ">
                            <input class="span5 input-xlarge" id="appendedInputButton" type="text" placeholder="搜索@host #node ~ip ">
                            <button class="btn btn-primary" type="button">搜索</button>
                        </div>
                    </div>

            </div>
        </div>
            </div>
        <div id="lB" class="tab-pane">
            <!-- Duoshuo Comment BEGIN -->
            <div class="ds-thread"></div>
            <script type="text/javascript">
                var duoshuoQuery = {short_name:"plato"};
                (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = 'http://static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0]
                        || document.getElementsByTagName('body')[0]).appendChild(ds);
                })();
            </script>
            <!-- Duoshuo Comment END -->

        </div>
        <div id="lC" class="tab-pane">
            <iframe src="http://www.bootcss.com/p/git-guide/" width="100%" align="center" height="420px" frameborder="0" scrolling="auto"></iframe>

        </div>
        <div id="lD" class="tab-pane">
            <iframe src="http://112.25.34.10:60000/hello.html" width="100%" align="center" height="420px" frameborder="0" scrolling="auto"></iframe>

        </div>
        <div id="lE" class="tab-pane">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#home">Linux</a></li>
                <li><a href="#profile">程序设计</a></li>
                <li><a href="#messages">网络相关</a></li>
                <li><a href="#settings">技术潮流</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <iframe src="http://www.chenqing.org" width="100%" align="center" height="420px" frameborder="0" scrolling="auto">

                    </iframe>

                </div>
                <div class="tab-pane" id="profile">2</div>
                <div class="tab-pane" id="messages">3</div>
                <div class="tab-pane" id="settings">4</div>
            </div>
            <script>
                $('#myTab a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                })

            </script>


        </div>
    </div>
</div>
<script>
    $.messager.show({
        title:'欢迎您',
        msg:'欢迎过来转转',
        showType:'show'
    });
</script>