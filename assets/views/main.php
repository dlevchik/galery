<div class="container" id="gallery">

    <?php foreach ($imgs as $item) { extract($item);?>
        <picture class="GalleryItem">
            <span class="title"><?= htmlspecialchars($title) ?></span>
            <img src="<?= $path ?>" alt="<?= htmlspecialchars($title) ?>">
            <p class="description">
                <?= htmlspecialchars($description) ?>
            </p>

            <?php if(isset($_SESSION['auth']) && ($user_id == $_SESSION['auth']['id'] || $_SESSION['auth']['status_id'] == 2)){?>
                <a class="delete button" href="?del=<?= $id ?>&hash=<?= $_SESSION['auth']['password'] ?>">Delete photo</a>
            <?php } ?>

        </picture>
    <?php } ?>

</div>

<div class="modalPicture modalContainer" id="modalPicture">
    <button class="arrow arrow-left">
        &#10094;
    </button>
    <div class="modalContent">
        <div class="container">
            <picture>
                <img src="img/020.jpg" alt="title">
            </picture>
            <div class="info">
                <span class="title">title</span>
                <p class="description">
                    description
                </p>
                <a class="download button" href="img/" download>Download</a>
            </div>
        </div>
    </div>
    <button class="arrow arrow-right">
        &#10095;
    </button>
</div>