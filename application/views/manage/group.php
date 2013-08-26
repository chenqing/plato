
        <div class="row">
            <div class="span2 well">
                <ul class="nav  nav-stacked nav-list ">
                    <li class="nav-header"><span class="icon-user"></span>用户组管理</li>
                    <li><a href="#groupAdd" data-toggle="modal"><span class="icon-plus"></span>增加用户组</a></li>
                    <li><a href=""><span class="icon-search"></span>浏览用户组</a></li>
                    <li>&nbsp</li>
                </ul>
            </div>

            <!-- Modal of groupadd -->
            <div id="groupAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">增加用户组</h3>
                </div>
                <div class="modal-body">
                    <div class="alert alert-error  hide fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p id="error"></p>
                    </div>

                    <form class="form-horizontal" method="post" >
                        <fieldset>

                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label" for="input01">用户组名</label>
                                <div class="controls">
                                    <input type="text" placeholder="" name="group_name" id="group_name" value="">
                                    <p class="help-block" id="hello"></p>
                                </div>
                            </div>

                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label" for="input01">用户组描述</label>
                                <div class="controls">
                                    <textarea rows="3" name="group_desc" id="group_desc"></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>

                        </fieldset>






                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <input class="btn btn-primary" type="submit" value="保存" id="submit"/>

                </div>
                </form>

            </div>
            <!--end of Modal groupadd -->
            <!-- Modal of groupedit -->
            <div id="groupEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">编辑用户组</h3>
                </div>
                <div class="modal-body">
                    <div class="alert alert-error  hide fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p id="error"></p>
                    </div>
                    <form class="form-horizontal" method="post" >
                        <fieldset>

                            <div class="control-group">
                                <input type="hidden" id="user_id" value="">
                                <!-- Text input-->
                                <label class="control-label" for="input01">用户组名</label>
                                <div class="controls">
                                    <input type="text" placeholder="" name="group_name" id="group_name" value="">
                                    <p class="help-block" id="hello"></p>
                                </div>
                            </div>

                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label" for="input01">用户组描述</label>
                                <div class="controls">
                                    <textarea rows="3" name="group_desc" id="group_desc"></textarea>
                                    <p class="help-block"></p>
                                </div>
                                <input type="hidden" id="group_id" value="">
                            </div>

                        </fieldset>


                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <input class="btn btn-primary" type="submit" value="保存" id="submit"/>

                </div>
                </form>

            </div>
            <!--end of Modal groupedit -->
            <!-- begin of Modal groupDelete  -->
            <!-- end of Modal groupDelete  -->

    <!-- start of span9 table of group list -->
            <div class="span9">
                <div class="alert alert-error  hide fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p id="error"></p>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>

                    <tr>
                        <th>用户组id</th>
                        <th>组名称</th>
                        <th>组描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($group as $item):?>
                    <tr>
                        <td><?php echo $item->group_id; ?></td>
                        <td><?php echo $item->group_name; ?></td>
                        <td><?php echo $item->group_desc; ?></td>
                        <td><a href="#groupDelete" data-toggle="modal"><span class="icon-remove" data-id="<?php echo $item->group_id; ?>"></span></a>
                            <i>		</i>
                            <a href="#groupEdit"  class="none" data-toggle="modal" title="编辑" data-id="<?php echo $item->group_id; ?>"><span class="icon-edit" title=""></span></a></td>

                    </tr>
                    <?php endforeach ;?>
                    </tbody>
                </table>
                <?php echo $links; ?>

            </div>
        </div>
     <!-- end of span9 & end of group list -->
    </div>
    <div id="push"></div>
</div><!-- end of wrap -->
        <!-- begin of javascript -->
        <script src="<?php echo base_url('assets/js/group.function.js'); ?>"></script>
