<div class="grid" ng-controller="userinfo" >
    <div class="toolbar">
        <div class="search">
            <label>用户: <input  class="input" ng-model="info.username" /> </label>
            <label>内容:
                <input  class="input" ng-model="info.content" />
            </label>
            <label><span class="button" ng-click="search()"> 查 找 </span> </label>

        </div>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>内容</th>
                    <th>用户</th>
                    <th>时间</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in list">
                    <td ng-bind="item['id']"></td>
                    <td ng-bind="item['content']"></td>
                    <td ng-bind="item['username']">
                    <td ng-bind="item['add_time']*1000 | date:'yyyy-MM-dd  HH:mm:ss' ">
                    <td ng-bind="item['add_ip']">
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <?= $this->partial('public/paging') ?>

</div>

<script src="/js/operlog.js"></script>