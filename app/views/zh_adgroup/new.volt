<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("zh_adgroup", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create zh_adgroup
    </h1>
</div>

{{ content() }}

{{ form("zh_adgroup/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPermission" class="col-sm-2 control-label">Permission</label>
    <div class="col-sm-10">
        {{ text_field("permission", "size" : 30, "class" : "form-control", "id" : "fieldPermission") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAddTime" class="col-sm-2 control-label">Add Of Time</label>
    <div class="col-sm-10">
        {{ text_field("add_time", "type" : "numeric", "class" : "form-control", "id" : "fieldAddTime") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUpdateTime" class="col-sm-2 control-label">Update Of Time</label>
    <div class="col-sm-10">
        {{ text_field("update_time", "type" : "numeric", "class" : "form-control", "id" : "fieldUpdateTime") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldActive" class="col-sm-2 control-label">Active</label>
    <div class="col-sm-10">
        {{ text_field("active", "type" : "numeric", "class" : "form-control", "id" : "fieldActive") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
