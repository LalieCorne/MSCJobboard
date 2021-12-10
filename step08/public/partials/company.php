<link href="<?=_ROOT_URL_?>/public/assets/css/company.css" rel="stylesheet">

<div class="container">
    <div id="companies" class="row d-flex p-3 justify-content-center"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $.ajax({
            method: "get",
            url: "http://127.0.0.1:3000/api/companies/read.php"
        })
        .done(function(response){
            companies = response.body
            for ($k=0; $k<(response.itemCount); $k++) {
                company = companies[$k];
                $content = $("#companies").html()
                $content = $content +
                    '<div class="card comp col-12">'+
                        '<div class="container comp_title">'+
                            '<div class="row align-items-start">'+
                                '<div class="col">'+
                                    '<h3 class="card-title">'+company.name+'</h3>'+
                                    company.labelCity+"<br>"+company.labelSector+
                                '</div>'+
                                '<div class="col comp-info">'+
                                company.creation_date+'<br>'+company.phone+'<br>'+company.email+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-text comp-content">'+
                            '<p class="comp-text">'+
                                company.description.substring(0,300)+" ..."+
                            '</p>'+
                            '<div class="row d-flex p-3 justify-content-center"><button class="red_button comp-btn"><a class="comp-btn-text" href="http://127.0.0.1:3000/view/profile-company.php?id_company='+ company.id_companies+'">Learn more</a></button></div>'+
                        '</div>'+
                    '</div>';
                $("#companies").html($content);
            };
        })
        .fail(function() {
        });
    });
</script>
