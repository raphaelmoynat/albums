<h1>All the albums</h1>

<?php use Core\Session\Session;




foreach ($albums as $album): ?>

    <div class="card mb-3">
        <div class="card-header">
            Album
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $album->getName() ?></h5>
            <p class="card-text"><?= $album->getArtist() ?></p>
            <p class="card-text"><?= $album->getYear() ?></p>
            <p class="fs-5 mt-5">Publié par : <?= $album->getAuthor()->getUsername() ?></p>
            <a href="?type=album&action=show&id=<?= $album->getId() ?>" class="btn btn-primary">Voir</a>
            <?php if (Session::userConnected() && Session::user()['id'] == $album->getUserId()): ?>
            <a href="?type=album&action=edit&id=<?= $album->getId() ?>" class="btn btn-warning">Edit</a>
            <a href="?type=album&action=delete&id=<?= $album->getId() ?>" class="btn btn-danger">Delete</a>
            <?php endif; ?>

        </div>
    </div>


<?php endforeach; ?>

