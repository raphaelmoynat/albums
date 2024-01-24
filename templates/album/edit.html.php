<form action="?type=album&action=edit" method="post" class="form-control">

    <input placeholder="name" type="text" name="name" class="form-control mb-2" value="<?= $album->getName() ?>">
    <input placeholder="artist" type="text" name="artist" class="form-control mb-2" value="<?= $album->getArtist() ?>">
    <input placeholder="year" type="text" name="year" class="form-control mb-2" value="<?= $album->getYear() ?>">

    <input type="hidden" name="idAlbum"  value="<?= $album->getId() ?>">


    <button class="btn btn-primary mt-3" type="submit" >Modifier</button>

</form>

<a class="btn" href="?type=album&action=index">Retour</a>
