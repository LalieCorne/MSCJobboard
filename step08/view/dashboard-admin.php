<?php
$title = '';
include("../controler/import-head.controler.php");
include("../controler/index.controler.php");
?>

<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<h2 class="page_title">Admin dashboard</h2>

<select  class="select" aria-label="Default select example" id="table-select">
    <option value="">Select table</option>
    <option value="people">Users</option>
    <option value="people-admin">User (admin)</option>
    <option value="companies">Companies</option>
    <option value="sector">Sector</option>
    <option value="C">Cities (coming soon)</option>
    <option value="A">Advertisements (coming soon)</option>
    <option value="AT">Advertisements type (coming soon)</option>
</select>

<?php
include(_ROOT_DIR_."/partials/table-admin.php");
?>
<?php 
    include(_ROOT_DIR_."/partials/modal/modify-modal.php");
    include(_ROOT_DIR_."/partials/modal/delete-modal.php");
    include(_ROOT_DIR_."/partials/modal/add-line-modal.php");
?>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        
        var table = $('#table_id').DataTable({
            "autoWidth": false
        });

        $("#table-select").change( function () {
            $("#table-title").text($("#table-select option:selected").text())
            if($("#table-select option:selected").val() == ""){
                $('#card-table').hide();
            }else if($("#table-select option:selected").val() == 'people'){
                //$('#table-head-tr').html('')
                table.draw();
                
                $('#card-table').show();
                $('#plus-button').hide();
                table.ajax.url('http://127.0.0.1:3000/api/people/read-table.php').load(function(){
                    $('th-1').html('Prenom nom');
                    $('th-2').html('Email');
                    $('th-3').html('Status');
                    $('th-4').html('');
                    
                    $(".select-people").change(function() {
                        $.ajax({
                                type :"post",
                                url: "http://127.0.0.1:3000/api/people/update.php",
                                dataType: "json",
                                data: JSON.stringify({
                                    "id_people" : $(this).attr('data-id'),
                                    "activate" : $(this).val()
                                })
                            })
                            .done(function(result){
                            }).fail(function(){
                                console.log('error')
                            })
                    });
                })
                
            }else if($("#table-select option:selected").val() == 'people-admin'){
                //$('#table-head-tr').html('')
                table.draw();
                
                $('#card-table').show();
                $('#plus-button').hide();
                table.ajax.url('http://127.0.0.1:3000/api/people/read-admin-table.php').load(function(){
                    $('th-1').html('Prenom nom');
                    $('th-2').html('Email');
                    $('th-3').html('Status');
                    $('th-4').html('');
                    
                    $(".select-people").change(function() {
                        $.ajax({
                                type :"post",
                                url: "http://127.0.0.1:3000/api/admin/update.php",
                                dataType: "json",
                                data: JSON.stringify({
                                    "id_admin" : $(this).attr('data-id'),
                                    "activate_admin" : $(this).val()
                                })
                            })
                            .done(function(result){
                            }).fail(function(){
                                console.log('error')
                            })
                    });
                });
                
            }else if($("#table-select option:selected").val() == 'companies'){
                //$('#table-head-tr').html('')
                table.draw();
                
                $('#card-table').show();
                $('#plus-button').hide();
                table.ajax.url('http://127.0.0.1:3000/api/companies/read-table.php').load(function(){
                    $('th-1').html('Nom');
                    $('th-2').html('Email');
                    $('th-3').html('Sector');
                    $('th-4').html('');
                    
                    $(".select-people").change(function() {
                        $.ajax({
                                type :"post",
                                url: "http://127.0.0.1:3000/api/companies/update.php",
                                dataType: "json",
                                data: JSON.stringify({
                                    "id_companies" : $(this).attr('data-id'),
                                    "activate" : $(this).val()
                                })
                            })
                            .done(function(result){
                            }).fail(function(){
                                console.log('error')
                            })
                    });
                });
                
            }else if($("#table-select option:selected").val() == 'sector'){
                //$('#table-head-tr').html('')
                table.draw();
                
                $('#card-table').show();
                $('#plus-button').show();
                table.ajax.url('http://127.0.0.1:3000/api/sector/read-table.php').load(function(){
                    $('th-1').html('Nom');
                    $('th-2').html('Email');
                    $('th-3').html('Sector');
                    $('th-4').html('');

                    $('.modify-button').click(function(){
                        $('#modifyModal #id_sector').attr('value',($(this).attr('data-id')))
                    })

                    $('.delete-button').click(function(){
                        $('#deleteModal #id_sector').attr('value',($(this).attr('data-id')))
                    })
                    
                    $(".select-people").change(function() {
                        $.ajax({
                                type :"post",
                                url: "http://127.0.0.1:3000/api/sector/update.php",
                                dataType: "json",
                                data: JSON.stringify({
                                    "id_companies" : $(this).attr('data-id'),
                                    "activate" : $(this).val()
                                })
                            })
                            .done(function(result){
                            }).fail(function(){
                                console.log('error')
                            })
                    });
                });
                
            }else{
                $('#table-head-tr').html('<th>oups</th>')
                $('#card-table').show();
                $('#plus-button').show();
            }
        });
        $('#table-select').change();
    });
</script>

<?php
include("../controler/import-foot.controler.php");
?>