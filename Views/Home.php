<?php
use \Controllers\AdminController as AdminController;
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css" type="text/css">
<?php
if(isset($_SESSION['save_success'])) {
?>
    <div class="alert alert-success" role="alert">
        <strong>Save success</strong>
    </div>
<?php
}
unset($_SESSION['save_success']);
?>

<div class="container">
    <h1>Tasks List</h1>

    <table data-toggle="table"
           data-page-size="3"
           data-page-list="[3]"
           data-pagination="true"
           data-side-pagination="server"
           data-url="/site/getalltasks/"
           data-row-style="rowStyle"
    >
        <thead>
            <th data-sortable="true" data-field="is_completed" data-formatter="completedFormatter">Completed</th>
            <th data-field="id">Item ID</th>
            <th data-sortable="true" data-field="username">Username</th>
            <th data-sortable="true" data-field="email">Email</th>
            <th data-field="description">Description</th>
            <th data-field="image" data-formatter="imageFormatter">Image</th>
            <?php if(AdminController::checkAdmin()){?>
                <th data-formatter="editFormatter"></th>
            <?php }?>

        </thead>
    </table>
</div>

<script>

    function editFormatter(value, row, index, field){
        return '<a href="/admin/edit/' + row.id + '"><span class="oi oi-pencil"></span></a>';
    }

    function completedFormatter(value, row, index, field){

        if(value == 1){
            return '<span class="oi oi-check"></span>';
        } else {
            return '';
        }

    }

    function imageFormatter(value, row, index, field){
        if(value !== null){
            return "<img class='preview-image' src='public/upload/images/task/" + value +"'>";
        } else {
            return "<img class='preview-image' src='public/img/no_image.jpg'>";
        }
    }

    function rowStyle(row, index) {
        if(row.is_completed == 1){
            return { css: {"background-color": "#dff0d8"} };
        } else {
            return { css: {"background-color": "#f2dede"} };
        }
    }

</script>