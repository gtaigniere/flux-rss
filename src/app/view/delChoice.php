<?php
use App\Util\ErrorManager;

if (isset($id)) {
?>

    <section class="sect-del_choice">

        <h1>Choix du type de suppression</h1>

        <?php
        foreach (ErrorManager::getMessages() as $message) : ?>
            <p class="alert alert-danger" role="alert">
                <?= $message ?>
            </p>
        <?php endforeach;
        ErrorManager::destroy();
        ?>

        <p>Voulez-vous supprimer le flux avec ses articles ou sans ?</p>
        <p class="take-care">Attention, la suppression d'un flux seul, laissera ses articles orphelins !</p>
        <p>Ils pourront être afficher dans la section "Orphelins" depuis la barre de navigation.</p>
        <form action="?target=feed&action=del&id=<?= $id ?>" method="POST">
            <p>
                <button class="btn btn-secondary" name="article" value="1">Avec</button>
                <button class="btn btn-dark" name="article" value="0">Sans</button>
            </p>
            <p><a class="btn btn-info" href="index.php">Annuler</a></p>
        </form>

    </section>

<?php
}
?>
