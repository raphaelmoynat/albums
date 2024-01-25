<?php

use Core\Session\Session;

?>

<a class="mt-5 " href="?type=album&action=index">Retour</a>


<div class="card mb-3">
    <div class="card-header">
        Album
    </div>
    <div class="card-body">
        <h5 class="card-title"><?= $album->getName() ?></h5>
        <p class="card-text"><?= $album->getArtist() ?></p>
        <p class="card-text"><?= $album->getYear() ?></p>
    </div>
</div>


<?php foreach ($album->getComments() as $comment): ?>
    <div class="border border-warning rounded mb-3 p-1">
            <h6 class="fs-5"><strong><?= $comment->getContent() ?></strong></h6>
            <p class="fs-5 mt-5">Auteur : <?= $comment->getAuthor()->getUsername() ?></p>
        <?php if(Session::userConnected() && Session::user()['id'] == $comment->getUserId()): ?>
            <a href="?type=comment&action=delete&id=<?= $comment->getId() ?>" class="btn btn-danger">Supprimer</a>
            <a href="?type=comment&action=update&id=<?= $comment->getId() ?>" class="btn btn-warning">Editer</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php if(Session::userConnected()): ?>
<div>
    <form action="?type=comment&action=create" method="post" class="mt-5">

        <div>
            <input class="form-control" type="text" name="content" placeholder="ecrire un commentaire">
        </div>
        <input type="hidden" name="albumId" value="<?= $album->getId() ?>">
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Commenter</button>
        </div>

    </form>
</div>
<?php endif; ?>

