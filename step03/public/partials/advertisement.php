<link href="<?=_ROOT_URL_?>/public/assets/css/advertisement.css" rel="stylesheet">

<div class="card" id="ad">
    <div class="container" id="ad_title">
        <div class="row align-items-start">
            <div class="col">
                <h3 class="card-title">ad title</h3>
            </div>
            <div class="col date">
                <a href="" class="ad_link">Companie</a><br>
                date de création
            </div>
        </div>
    </div>
    <p class="card-text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis a molestiae ut harum veniam minus quisquam, saepe libero error aut illum iste! Cumque dolorum fugit recusandae nobis! Voluptates, reprehenderit nostrum?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium nemo pariatur illo iusto. Minus vero voluptas suscipit dolore necessitatibus animi, vitae non perspiciatis recusandae ducimus obcaecati cum eum. Eum, ut!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam officia architecto totam quas delectus quam explicabo placeat optio minima quia unde, perspiciatis quasi, est natus cumque consequuntur! Tempore, obcaecati laborum!
    </p>
    <button id="learn-more" type="button" data-bs-toggle="modal" data-bs-target="#advertisementModal">
        Learn more
    </button>
</div>

<?php include(_ROOT_DIR_."/partials/modal/advertisement-modal.php")
?>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var myModal = document.getElementById('advertisementModal')
        var myInput = document.getElementById('learn-more')
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
});
</script>