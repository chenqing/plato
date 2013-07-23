
        <div class="row">
            <div class="span2 well">
                <ul class="nav  nav-stacked nav-list ">
                    <li class="nav-header"><span class="icon-user"></span>用户管理</li>
                    <li><a href="#userAdd" data-toggle="modal"><span class="icon-plus"></span>增加用户</a></li>
                    <li><a href=""><span class="icon-search"></span>浏览用户</a></li>
                    <li>&nbsp</li>
                </ul>
            </div>

            <!-- begin of user add -->
            <div id="userAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">增加用户</h3>
                </div>
                <div class="modal-body">
                    <div class="alert alert-error  hide fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p id="error"></p>
                    </div>


                    <form class="form-horizontal" method="post">
                        <fieldset>

                            <div class="control-group">
                                <!-- Text input-->
                                <label class="control-label" for="input01">用户名</label>
                                <div class="controls">
                                    <input  name="user_name" id="user_name" type="text" placeholder="在chinache 的用户名" class="input-xlarge">
                                    <p class="help-block"></p>
                                </div>
                            </div>

                            <div class="control-group">
                                <!-- Select Basic -->
                                <label class="control-label">用户组</label>
                                <div class="controls">
                                    <select class="input-xlarge" name="group" id="group">

                                        <?php foreach( $this->User_model->get_group() as $group) : ?>
                                        <option value="<?php echo $group->group_id ?>"><?php echo $group->group_name ?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>

                            </div>

                            <div class="control-group">
                                <label class="control-label">权限</label>

                                <!-- Multiple Checkboxes -->
                                <div class="controls">
                                    <!-- Inline Checkboxes -->
                                    <label class="checkbox ">
                                        <input  name="privileges" type="checkbox" value="2" checked="checked">
                                        访问
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="4">
                                        增加
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="8">
                                        修改
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="16">
                                        删除
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="32">
                                        标准
                                    </label>
                                </div>

                            </div>

                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label">是否激活</label>
                                    <div class="control-group">

                                        <!-- Select Basic -->

                                        <div class="controls">
                                            <label class="radio inline">
                                                <input type="radio" name="active" id="active" value="1" checked>
                                                是
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="active" id="active" value="0">
                                                否
                                            </label>
                                        </div>

                                    </div>
                            </div>

                        </fieldset>


                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <input class="btn btn-primary" type="submit" value="保存">
                </div>
                </form>
            </div>
            <!--end of user add -->
            <!-- begin of user edit -->
            <div id="userEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">编辑用户</h3>
                </div>
                <div class="modal-body">
                    <div class="alert alert-error  hide fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p id="error"></p>
                    </div>


                    <form class="form-horizontal" method="post">
                        <fieldset>

                            <div class="control-group">
                                <!-- Text input-->
                                <input type="hidden" id="user_id" name="user_id" value="">
                                <label class="control-label" for="input01">用户名</label>
                                <div class="controls">
                                    <input  name="user_name" id="user_name" type="text" placeholder="在chinache 的用户名" class="input-xlarge " disabled="disabled">
                                    <p class="help-block"></p>
                                </div>
                            </div>

                            <div class="control-group">
                                <!-- Select Basic -->
                                <label class="control-label">用户组</label>
                                <div class="controls">
                                    <select class="input-xlarge" name="group" id="group">

                                        <?php foreach( $this->User_model->get_group() as $group) : ?>
                                            <option value="<?php echo $group->group_id ?>"><?php echo $group->group_name ?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>

                            </div>

                            <div class="control-group">
                                <label class="control-label">权限</label>

                                <!-- Multiple Checkboxes -->
                                <div class="controls">
                                    <!-- Inline Checkboxes -->
                                    <label class="checkbox ">

                                        <input  name="privileges" type="checkbox" value="2" >
                                        访问
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="4">
                                        增加
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="8">
                                        修改
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="16">
                                        删除
                                    </label>
                                    <label class="checkbox ">
                                        <input name="privileges" type="checkbox" value="32">
                                        标准
                                    </label>
                                </div>

                            </div>

                            <div class="control-group">

                                <!-- Text input-->
                                <label class="control-label">是否激活</label>
                                <div class="control-group">

                                    <!-- Select Basic -->

                                    <div class="controls">
                                        <label class="radio inline">
                                            <input type="radio" name="active" id="active" value="1" checked>
                                            是
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="active" id="no_active" value="0">
                                            否
                                        </label>
                                    </div>

                                </div>
                            </div>

                        </fieldset>


                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <input class="btn btn-primary" type="submit" value="保存">
                </div>
                </form>
            </div>
            <!--end of user edit -->
        <!-- begin of user list -->
		<div class="span9">
            <div class="alert alert-error  hide fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p id="error"></p>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>

                <tr>
                    <th>用户id</th>
                    <th>用户名</th>
                    <th>所属组</th>
                    <th>权限值</th>
                    <th>上次登陆</th>
                    <th>是否激活</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($user as $item):?>
                    <tr>
                        <td><?php echo $item->user_id; ?></td>
                        <td><?php echo $item->user_name; ?></td>
                        <td><?php echo $this->Group_model->get_group_name_by_id($item->group_id); ?></td>
                        <td><?php echo $item->user_privilege; ?></td>
                        <td><?php echo $item->last_login; ?></td>
                        <td><?php echo $t = ($item->is_active == 1)?"是":"否";  ?></td>
                        <td><a href="#userDelete" data-toggle="modal"><span class="icon-remove" data-id="<?php echo $item->user_id; ?>"></span></a>
                            <i>		</i>
                            <a href="#userEdit"  class="none" data-toggle="modal" title="编辑" data-id="<?php echo $item->user_id; ?>"><span class="icon-edit" title=""></span></a></td>

                    </tr>
                <?php endforeach ;?>
                </tbody>
            </table>
            <?php echo $links; ?>


		</div>
        <!--end of user list -->
	</div>
</div>
			<div id="push"></div>
</div><!-- end of wrap -->
    <!-- begin of javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/user.function.js') ?>"></script>


    <!-- end of javascript -->
