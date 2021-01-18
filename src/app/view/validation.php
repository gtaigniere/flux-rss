<?php
use App\Util\ErrorManager;

if (isset($datas)) {
?>

<section class="sect-valid">

    <h1>Demande de confirmation</h1>

    <?php
    foreach (ErrorManager::getMessages() as $message) : ?>
        <p class="alert alert-danger" role="alert">
            <?= $message ?>
        </p>
    <?php endforeach;
    ErrorManager::destroy();
    ?>

    <form method="POST">

        <?php foreach($datas as $name => $value) : ?>
            <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
        <?php endforeach; ?>

        <p>Etes-vous sûr ?</p>

        <button class="btn btn-success" name="validate" value="true">Confirmer</button>
        <p><a class="btn btn-info" href="index.php">Annuler</a></p>

    </form>

</section>

<?php
}
?>
