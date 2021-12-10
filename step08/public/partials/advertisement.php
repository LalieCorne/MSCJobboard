<link href="<?=_ROOT_URL_?>/public/assets/css/advertisement.css" rel="stylesheet">

<div class="container">
    <div id="advertisement" class="row d-flex p-3 justify-content-center"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $.ajax({
            method: "get",
            url: "http://127.0.0.1:3000/api/advertisement/read.php"
        })
        .done(function(response){
            $ads = response.body
            for ($k=0; $k<(response.itemCount); $k++) {
                $ad = $ads[$k];
                $content = $("#advertisement").html()
                $content = $content +
                    '<div class="card ad col-12">'+
                        '<div class="container ad_title">'+
                            '<div class="row align-items-start">'+
                                '<div class="col">'+
                                    '<h3 class="card-title">'+$ad.title+'</h3>'+
                                '</div>'+
                                '<div class="col ad-info">'+
                                $ad.creation_date+'<br>'+$ad.labelCompanies+"<br>"+$ad.labelType+"<br>"+$ad.labelCity+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-text ad-content" id="'+$ad.id_advertisement+'">'+
                            '<p class="ad-text">'+
                                $ad.description.substring(0,150)+" ..."+
                            '</p>'+
                            '<button class="red_button ad-btn show-more" data-id="'+$ad.id_advertisement+'">Show more</button>'+
                        '</div>'+
                    '</div>';
                $("#advertisement").html($content);
            };
            $('.show-more').click(function () {
                $id = $(this).attr('data-id');
                $ad_desc = $ads[response.itemCount-$id]
                $('#'+$id).html('<p class="ad-text">'+
                        $ad_desc.description+
                        '</p>'+
                        '<button class="red_button ad-btn launchApplyModal" type="button" data-bs-toggle="modal" data-bs-target="#applyModal">'+
                            'Apply'+
                        '</button>'+
                        '<button class="red_button ad-btn show-less" data-id="'+$ad_desc.id_advertisement+'">'+
                        'Show less'+
                        '</button>'
                        )
                $("#id_company").val($ad_desc.id_companies);
            });
            $('.show-less').click(function () {
                $id = $(this).attr('data-id');
                $ad_desc = $ads[response.itemCount-$id]
                $('#'+$id).html('<p class="ad-text">'+
                        $ad_desc.description.substring(0,150)+" ..."+
                        '</p>'+
                        '<button class="red_button ad-btn show-more" data-id="'+$ad.id_advertisement+'">Show more</button>'
                        )
            });
        })
        .fail(function() {
        });
    });
</script>

<?php include(_ROOT_DIR_."/partials/modal/apply-form-modal.php")
?>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var myModal = document.getElementById('applyModal')
        var myInput = $(".launchApplyModal")
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    });
</script>
