<div class="row">
    <div class="span2 well">
        <img src="http://saltstack.com/images/SaltStack-Logo.png">
    </div>
    <div class="span9">
        <div class="bs-docs-example" style="hight:400px;">
            <ul id="myTab" class="nav nav-tabs">
                <li class=""><a href="#home" data-toggle="tab">设备初始化</a></li>
                <li class="active"><a href="#profile" data-toggle="tab">远程执行</a></li>
                <li class=""><a href="#profile" data-toggle="tab">模块管理</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">salt管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#dropdown1" data-toggle="tab">minion状态</a></li>
                        <li><a href="#dropdown2" data-toggle="tab">状态管理</a></li>
                    </ul>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade " id="home">
                    <form class="form-horizontal " method="post">
                        <fieldset>

                            <div class="control-group">
                                <!-- Select Basic -->
                                <label class="control-label">选择安装套餐</label>
                                <div class="controls" >
                                    <select class="input-xlarge" name="group" >
                                        <option value="" selected="selected">选择安装套餐</option>
                                        <option value="1">FC7-web</option>
                                        <option value="2">FC7-video</option>
                                        <option value="3">FC7-download</option>
                                        <option value="4">FSCS</option>
                                        <option value="4">FDNS</option>
                                        <option value="4">LVS+keepalive</option>




                                    </select>
                                </div>

                            </div>
                            <div class="control-group">
                                <!-- Select Basic -->
                                <label class="control-label">选择目标机器</label>
                                <div class="controls" >
                                    <select class="input-xlarge " name="group" id="target1">
                                        <option value="" selected="selected">选择target方式</option>
                                        <option value="1">主机组</option>
                                        <option value="2">单台主机</option>
                                        <option value="3">主机列表</option>
                                        <option value="4">正则模式</option>


                                    </select>
                                    <div id="select" style="margin-top: 20px;"></div>
                                </div>

                            </div>


                            <div class="control-group text-center">
                                <input class="btn btn-success" type="submit" value="开始部署">
                            </div>

                        </fieldset>

                    </form>
                    <pre class="brush: bash">
 df -h
Filesystem      Size   Used  Avail Capacity  iused    ifree %iused  Mounted on
/dev/disk0s2   428Gi  181Gi  246Gi    43% 47626366 64494751   42%   /
devfs          192Ki  192Ki    0Bi   100%      663        0  100%   /dev
map -hosts       0Bi    0Bi    0Bi   100%        0        0  100%   /net
map auto_home    0Bi    0Bi    0Bi   100%        0        0  100%   /home
/dev/disk0s4    37Gi   31Gi  6.1Gi    84%   138616  6349708    2%   /Volumes/Untitled
/dev/disk2s1   500Mi   51Mi  449Mi    11%    13127   114861   10%   /Volumes/Java 7 Update 25
                    </pre>
                    <div class="spin hidden text-center">
                        <span class=" icon-spinner icon-4x icon-spin" ></span>
                    </div>
                    <div id="result" class="well hidden">


                    </div>
                </div>
                <div class="tab-pane fade active in" id="profile">
                    <form class="form-horizontal " method="post">
                        <fieldset>

                            <div class="control-group">
                                <!-- Select Basic -->
                                <label class="control-label">选择目标机器</label>
                                <div class="controls" >
                                    <select class="input-xlarge" name="group" id="target2">
                                        <option value="" selected="selected">选择target方式</option>
                                     <option value="1">主机组</option>
                                      <option value="2">单台主机</option>
                                        <option value="3">主机列表</option>
                                        <option value="4">正则模式</option>


                                    </select>
                                    <div id="select1" style="margin-top: 20px;"></div>
                                </div>

                            </div>
                            <div class="control-group">
                                <!-- Text input-->
                                <label class="control-label" for="input01">输入命令</label>
                                <div class="controls">
                                    <input  name="user_name" id="user_name" type="text" placeholder="输入你可以执行的命令" class="input-xxlarge">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group text-center">
                            <input class="btn btn-success" type="submit" value="执行">
                            </div>

                        </fieldset>

                    </form>
                    <div class="spin hidden text-center">
                        <span class=" icon-spinner icon-4x icon-spin" ></span>
                    </div>
                    <div id="result" class="well hidden">


                    </div>
                </div>


                <div class="tab-pane fade" id="dropdown1">
                    <form name="cabinet_search" id="cabinet_search" class="form-inline datagrid-toolbar">
                        <input type="text" name="node_name" placeholder="输入minion名搜索" />
                        <button type="submit" class="btn ">搜索</button>
                    </form>
                    <table id="show-table" class="table table-hover table-condensed table-striped" style="margin-top: 5px;">
                        <tr><th>Minion ID </th><th>所属节点</th><th>主机名称</th><th>操作</th><th>详情查看</th></tr>
                        <?php foreach($cabinet as $c ):?>
                            <tr><td><?php echo $c->cab_id ;?></td><td><?php echo $this->Node_model->get_node_name($c->node_id );?></td><td><?php echo $c->cab_name ;?>
                                <td><a href="#cabinetEdit"   data-toggle="modal" data-id ="<?php echo $c->cab_id ;?>" class="edit-none btn btn-info btn-small	" >探测</a></td>
                                <td><button class="btn btn-warning btn-small	">查看</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="dropdown2">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#home #target1').change(function(){
            var selected = $(this).find('option:selected').val();
            var group = ' ';
            var single = ' ';
            var textarea = '';
            textarea += '<textarea style="width:260px;" rows="6"></textarea>';
            group += '<select class="input-xlarge" > <option value=NJ-S-FC>NJ-S-FC</option> <option value=NJ-Q-FC>NJ-Q-FC</option> <option value=NJ-M-FC>NJ-M-FC</option> <option value=NJ-L-FC>NJ-L-FC</option> <option value=NJ-K-FC>NJ-K-FC</option> <option value=NJ-H-FC>NJ-H-FC</option> <option value=NJ-R-FC>NJ-R-FC</option> <option value=NJ-4-FC>NJ-4-FC</option> <option value=NJ-5-FC>NJ-5-FC</option> <option value=NJ-6-FC>NJ-6-FC</option> <option value=NJ-4-FSCS>NJ-4-FSCS</option> <option value=NJ-5-FSCS>NJ-5-FSCS</option> <option value=NJ-6-FSCS>NJ-6-FSCS</option> <option value=NJ-S-FSCS>NJ-S-FSCS</option> <option value=NJ-M-FSCS>NJ-M-FSCS</option> <option value=NJ-Q-FSCS>NJ-Q-FSCS</option> <option value=NJ-L-FSCS>NJ-L-FSCS</option> <option value=NJ-K-FSCS>NJ-K-FSCS</option> <option value=NJ-H-FSCS>NJ-H-FSCS</option> <option value=NJ-R-FSCS>NJ-R-FSCS</option> <option value=FSCS>FSCS</option> <option value=FC>FC</option> </select>';
            single += '<input class="input-xlarge" type="text" placeholder="输入主机名称，注意大小写">';
            $('#profile #select').html('');

            switch(selected){
                case '1':
                $('#home #select').html(group);
                    break;
                case '2':
                    $('#home  #select').html(single);
                    break;
                case '3':
                    $('#home  #select').html(textarea);
                    break;
                default :
                    $('#home  #select').html('');
                    break;
            }
            });
        $('#profile #target2').change(function(){
            var selected = $(this).find('option:selected').val();
            var group = ' ';
            var single = ' ';
            var textarea = '';
            textarea += '<textarea style="width:260px;" rows="6"></textarea>';
            group += '<select class="input-xlarge" > <option value=NJ-S-FC>NJ-S-FC</option> <option value=NJ-Q-FC>NJ-Q-FC</option> <option value=NJ-M-FC>NJ-M-FC</option> <option value=NJ-L-FC>NJ-L-FC</option> <option value=NJ-K-FC>NJ-K-FC</option> <option value=NJ-H-FC>NJ-H-FC</option> <option value=NJ-R-FC>NJ-R-FC</option> <option value=NJ-4-FC>NJ-4-FC</option> <option value=NJ-5-FC>NJ-5-FC</option> <option value=NJ-6-FC>NJ-6-FC</option> <option value=NJ-4-FSCS>NJ-4-FSCS</option> <option value=NJ-5-FSCS>NJ-5-FSCS</option> <option value=NJ-6-FSCS>NJ-6-FSCS</option> <option value=NJ-S-FSCS>NJ-S-FSCS</option> <option value=NJ-M-FSCS>NJ-M-FSCS</option> <option value=NJ-Q-FSCS>NJ-Q-FSCS</option> <option value=NJ-L-FSCS>NJ-L-FSCS</option> <option value=NJ-K-FSCS>NJ-K-FSCS</option> <option value=NJ-H-FSCS>NJ-H-FSCS</option> <option value=NJ-R-FSCS>NJ-R-FSCS</option> <option value=FSCS>FSCS</option> <option value=FC>FC</option> </select>';
            single += '<input class="input-xlarge" type="text" placeholder="输入主机名称，注意大小写">';
            $('#home  #select').html('');

            switch(selected){
                case '1':
                    $('#profile #select1').html(group);
                    break;
                case '2':
                    $('#profile #select1').html(single);
                    break;
                case '3':
                    $('#profile #select1').html(textarea);
                    break;
                default :
                    $('#profile #select1').html('');
                    break;
            }
        });

        $('.form-horizontal').submit(function(e){
                e.preventDefault();
               // $('div.spin').removeClass('hidden');
               // setTimeout("$('div.spin').addClass('hidden')", 2000);
                setTimeout("$('div#result').removeClass('hidden').html('hello world')",2000);
            }

        );
        });
        SyntaxHighlighter.all()


</script>