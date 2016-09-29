<div class="grid" ng-controller="userinfo" >
    <div class="toolbar">
        <div class="search">
            <label>用户名: <input  class="input" ng-model="info.username" /> </label>
            <label>部 门:
                <select  class="input" ng-model="info.depart" >
                    <option value="">——请选择——</option>
                    <?php foreach ($departs as $depart) { ?>
                    <option value="<?= $depart['id'] ?>"><?= $depart['remark'] ?></option>
                    <?php } ?>
                </select>
            </label>
            <label><span class="button" ng-click="search()"> 查 找 </span> </label>

        </div>
        <div class="tool">
            <label><span class="button" ng-click="add()"> 新 增 </span> </label>&nbsp;&nbsp;
            <!--<label><span class="button" ng-click="del()"> 删 除 </span> </label>&nbsp;&nbsp;-->
        </div>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <!--<th><input type="checkbox"></th>-->
                    <th>ID</th>
                    <th>用户名</th>
                    <th>部门</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in list">
                    <!--<td><input type="checkbox" name="userid[]" value="{_ item['id'] _}" ></td>-->
                    <td ng-bind="item['id']"></td>
                    <td ng-bind="item['name']"></td>
                    <td ng-switch="item['depart']">
                        <?php foreach ($departs as $depart) { ?>
                        <span ng-switch-when="<?= $depart['id'] ?>"><?= $depart['remark'] ?></span>
                        <?php } ?>
                    </td>
                    <td><a ng-click="change(item)">[ 修 改 ]</a>&nbsp;&nbsp;<a ng-click="delete(item['id'])">[ 删 除 ]</a></td>
                </tr>

            </tbody>
        </table>
    </div>
    <?= $this->partial('public/paging') ?>

</div>
<div class="add" ng-controller="addController">
    <form name="addForm" >
        <table>
            <caption>添加新用户</caption>
            <tr>
                <th>用户名</th>
                <td><input class="biginput" ng-model="add.name" name="name" ng-maxlength="20" ng-minlength="2" required  ng-class="{'error':addForm.name.$invalid}" /></td>
            </tr>
            <tr>
                <th>部 门</th>
                <td> <select  class="biginput" ng-model="add.depart" name="depart" required  ng-class="{'error':addForm.depart.$invalid}">
                    <option value="">——请选择——</option>
                    <?php foreach ($departs as $depart) { ?>
                    <option value="<?= $depart['id'] ?>"><?= $depart['remark'] ?></option>
                    <?php } ?>
                </select></td>
            </tr>
            <tr>
                <th>密 码</th>
                <td><input type="password" name="passwd" class="biginput" ng-model="add.passwd"  ng-maxlength="20" ng-minlength="6" required  ng-class="{'error':addForm.passwd.$invalid}" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="bigbutton" value=" 确 定 " ng-disabled="addForm.$invalid" ng-click="addsub()" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div class="modify" >
    <form name="modifyForm" action="/system/chuser" method="post" >
        <table>
            <caption>修改用户</caption>
            <tr>
                <th>用户名</th>
                <td><input class="biginput"  name="name"  /></td>
            </tr>
            <tr>
                <th>部 门</th>
                <td> <select  class="biginput"  name="depart" >
                    <?php foreach ($departs as $depart) { ?>
                    <option value="<?= $depart['id'] ?>"><?= $depart['remark'] ?></option>
                    <?php } ?>
                </select></td>
            </tr>
            <tr>
                <th>冻 结</th>
                <td><input type="radio" value="1" name="active" >否 &nbsp; <input type="radio" value="0" name="active" >是 </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id"   value="0" />
                    <input type="submit" class="bigbutton" value=" 确 定 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script src="/js/user.js"></script>