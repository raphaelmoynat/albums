

<form action="?type=comment&action=update" method="post">
    <div class="mb-3">
        <input class="form-control" type="text" name="content" value="<?= $comment->getContent() ?>">
    </div>
    <input type="hidden" value="<?= $comment->getId() ?>" name="id">
    <div>
        <button class="btn btn-primary" type="submit">Modifier</button>

    </div>

</form>
