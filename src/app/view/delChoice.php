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
            <button class="btn btn-secondary" name="with" value="true">Avec</button>
            <button class="btn btn-dark" name="with" value="false">Sans</button>
        </form>

    </section>

<?php
}
?>
