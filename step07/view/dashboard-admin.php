<?php
$title = '';
include("../controler/import-head.controler.php");
include("../controler/index.controler.php");
?>

<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<h2 class="page_title">Admin dashboard</h2>

<select  class="select" aria-label="Default select example" id="table-select">
    <option value="U">Users</option>
    <option value="AP">Appliers profile</option>
    <option value="CI">Companies informations</option>
    <option value="S">Sector</option>
    <option value="C">Cities</option>
    <option value="A">Advertisements</option>
    <option value="AT">Advertisements type</option>
</select>

<?php
include(_ROOT_DIR_."/partials/table-admin.php");
?>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
        $("#table-select").change( function () {
            $("#table-title").text($("#table-select option:selected").text())
        });
        $('#table-select').change();
    });
</script>

<?php
include("../controler/import-foot.controler.php");
?>