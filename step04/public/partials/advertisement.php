<link href="<?=_ROOT_URL_?>/public/assets/css/advertisement.css" rel="stylesheet">

<!-- <div class="card" id="ad">
    <div class="container" id="ad_title">
        <div class="row align-items-start">
            <div class="col">
                <h3 class="card-title">ad title</h3>
            </div>
            <div class="col date">
                Companies<br>
                date de création
            </div>
        </div>
    </div>
    <p class="card-text" id="content">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis a molestiae ut harum veniam minus quisquam, saepe libero error aut illum iste! Cumque dolorum fugit recusandae nobis! Voluptates, reprehenderit nostrum?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium nemo pariatur illo iusto. Minus vero voluptas suscipit dolore necessitatibus animi, vitae non perspiciatis recusandae ducimus obcaecati cum eum. Eum, ut!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam officia architecto totam quas delectus quam explicabo placeat optio minima quia unde, perspiciatis quasi, est natus cumque consequuntur! Tempore, obcaecati laborum!
    </p>
    <button>Learn more</button>
</div> -->
<?php

    foreach($objAdCollection->getVal('arrayObj') as $obj){
        $description = $obj->getVal('description');
        strlen($obj->getVal('description'))>=143 ? $description .= '...': '';
        $strToEcho .= 
        '<div class="card ad" id="ad-'.$obj->getVal('id_advertisement').'">
            <div class="container ad_title">
                <div class="row align-items-start">
                    <div class="col">
                        <h3 class="card-title">'.$obj->getVal('title').'</h3>
                    </div>
                    <div class="col date">
                        '.$obj->getVal('labelCompanies').'<br>
                        '.$obj->getVal('creation_date').'
                    </div>
                </div>
            </div>
            <p class="card-text" id="content">
                '.$description.'
            </p>
            <button class="learn-more" data-id="'.$obj->getVal('id_advertisement').'">Learn more</button>
        </div><br />';
    }
    echo $strToEcho;
?>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('.learn-more').click(function(){
            console.log($(this).attr('data-id'))
            $.ajax({
                url : "../public/ajax/getObject.ajax.php",
                method : 'post',
                dataType : 'json',
                data : {
                    'objet' : 'Advertisement',
                    'id' : $(this).attr('data-id')
                }
            })
            .done (function(reponse){
                
            })
            .fail(function() {
            })
        })
    });
</script>