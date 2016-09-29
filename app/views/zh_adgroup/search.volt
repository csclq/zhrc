<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("zh_adgroup/index", "Go Back") }}</li>
            <li class="next">{{ link_to("zh_adgroup/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Name</th>
            <th>Permission</th>
            <th>Add Of Time</th>
            <th>Update Of Time</th>
            <th>Active</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for zh_adgroup in page.items %}
            <tr>
                <td>{{ zh_adgroup.id }}</td>
            <td>{{ zh_adgroup.name }}</td>
            <td>{{ zh_adgroup.permission }}</td>
            <td>{{ zh_adgroup.add_time }}</td>
            <td>{{ zh_adgroup.update_time }}</td>
            <td>{{ zh_adgroup.active }}</td>

                <td>{{ link_to("zh_adgroup/edit/"~zh_adgroup.id, "Edit") }}</td>
                <td>{{ link_to("zh_adgroup/delete/"~zh_adgroup.id, "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("zh_adgroup/search", "First") }}</li>
                <li>{{ link_to("zh_adgroup/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("zh_adgroup/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("zh_adgroup/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
