<div class="grid" ng-controller="grid">
    <div class="toolbar">
        <div class="search">
            <label>用户名: <input ng-model="username" class="input" /> </label>
            <label>部 门: <input ng-model="depart" class="input" /> </label>
            <label><span class="button" ng-click="search()"> 查 找 </span> </label>

        </div>
        <div class="tool">
            <label><span class="button" ng-click="add()"> 新 增 </span> </label>&nbsp;&nbsp;
            <label><span class="button" ng-click="del()"> 删 除 </span> </label>&nbsp;&nbsp;
        </div>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>部门</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" ></td>
                    <td>1</td>
                    <td>张三</td>
                    <td>管理员</td>
                    <td><a href="#">[ 修 改 ]</a>&nbsp;&nbsp;<a href="#">[ 删 除 ]</a></td>
                </tr>
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>1</td>
                    <td>张三</td>
                    <td>管理员</td>
                    <td><a href="#">[ 修 改 ]</a>&nbsp;&nbsp;<a href="#">[ 删 除 ]</a></td>
                </tr>
                <tr>
                    <td><input type="checkbox" ></td>
                    <td>1</td>
                    <td>张三</td>
                    <td>管理员</td>
                    <td><a href="#">[ 修 改 ]</a>&nbsp;&nbsp;<a href="#">[ 删 除 ]</a></td>
                </tr>
                <tr>
                    <td><input type="checkbox" ></td>
                    <td>1</td>
                    <td>张三</td>
                    <td>管理员</td>
                    <td><a href="#">[ 修 改 ]</a>&nbsp;&nbsp;<a href="#">[ 删 除 ]</a></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>