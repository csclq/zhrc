<div class="permission">
    <form action="" method="post">
    <label style="display: inline-block;height: 30px;line-height: 30px;font-size: 18px;margin: 0 4px"><input type="checkbox" id="all" > 全选 </label><span onclick="add(0)"> 添加控制器</span>
    <?php foreach ($list as $controller) { ?>
        <div class="controller"><label style="display: inline-block;height: 30px;line-height: 30px;font-size: 18px;margin: 0 4px"><input name="app[]" type="checkbox" value="<?= $controller['id'] ?>"  <?php if ($controller['checked']) { ?> checked <?php } ?>  /> <?= $controller['remark'] ?></label><span onclick="add(<?= $controller['id'] ?>)">添加方法</span></div>
        <div class="action">
        <?php foreach ($controller['child'] as $action) { ?>
            <label style="display: inline-block;height: 30px;line-height: 30px;margin: 0 10px"><input name="app[]" type="checkbox" value="<?= $action['id'] ?>"   <?php if ($action['checked']) { ?> checked <?php } ?>  /> <?= $action['remark'] ?></label>
        <?php } ?>
        </div>
    <?php } ?>
    <br />
    <input type="submit" style="width: 150px;height: 30px;border-radius: 10px;background: #00a65a;color:#fff;font-size: 18px;cursor: pointer;text-align: center" value="确 &nbsp; &nbsp; &nbsp; &nbsp;   定" />
    </form>
</div>

<div class="add" ng-controller="addController" ng-init="add.show=1">
    <form name="addForm" >
        <table>
            <caption>添 加 应 用</caption>
            <tr>
                <th>名称(英文)</th>
                <td><input class="biginput" ng-model="add.name" name="name"  required ng-minlength="2" maxlength="10" ng-class="{'error':addForm.name.$invalid}" /></td>
            </tr>
            <tr>
                <th>描述(中文)</th>
                <td> <input  class="biginput" ng-model="add.remark" name="remark" required ng-minlength="2" maxlength="10" ng-class="{'error':addForm.remark.$invalid}">
                </td>
            </tr>
            <tr>
                <th>是否显示</th>
                <td> <input type="radio" ng-model="add.show" value="1" name="show" checked /> 是 &nbsp;&nbsp;<input type="radio" ng-model="add.show" value="0" name="show" /> 否
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="pid" ng-model="add.pid">
                    <input type="submit" class="bigbutton" value=" 确 定 " ng-disabled="addForm.$invalid" ng-click="addsub()" />
                </td>
            </tr>
        </table>
    </form>
</div>


<script>
    $("#all").click(function () {
        if($(this).is(':checked')){
            $(".permission").find("input:checkbox").prop("checked",true);
        }else{
            $(".permission").find("input:checkbox").prop("checked",false);
        }
    })
    $(".controller input:checkbox").click(function () {
        if($(this).is(':checked')){
            $(this).parents('.controller').next('.action').find("input:checkbox").prop("checked",true);
        }else{
            $(this).parents('.controller').next('.action').find("input:checkbox").prop("checked",false);
        }
    })
    $(".action input:checkbox").click(function () {
        if($(this).is(':checked')){
            $(this).parents('.action').prev('.controller').find("input:checkbox").prop("checked",true);
        }
    })

    function add(id) {
        $(".add form")[0].reset();
        $(".add input[name=pid]").val(id);
        $(".add").show();
    }
    myapp.controller('addController',function ($scope,$http) {
        $scope.add={};
        $scope.addsub=function () {
            $scope.add.pid=$(".add input[name=pid]").val();
//            console.log($scope.add);
            $http({
                'url':'/system/addapp',
                'method':'POST',
                'data':$scope.add
            }).success(function (a) {
                location.reload();
            })
        }
    })
</script>