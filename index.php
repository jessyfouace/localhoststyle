
<?php
$title = 'Localhost - Accueil';
?>

<?php include 'localhost/header.php'; ?>

<?php
$message = '';
    if (isset($_POST['projetremove'])) {
        rmdir($_POST['projetremove']);
        header('location: index.php');
    }
    if (isset($_POST['projetrename'])) {
        if (isset($_POST['newname'])) {
            if (!file_exists($_POST['newname'])) {
                chmod($_POST['projetrename'], 0777);
                rename($_POST['projetrename'], $_POST['newname']);
                header('location: index.php');
            } else {
                $message = 'Impossible de renommer le fichier ' . $_POST['projetrename'] . ' car le fichier ' . $_POST['newname'] . ' existe déjà.';
            }
        }
    }
?>
<div class="col-12 text-center">
    <h1>Bienvenue dans le <?php echo $_SERVER['SERVER_NAME']; ?></h1>
</div>


<div class="col-8 row mx-auto m-0 p-0">
    <form class="col-6 mx-auto p-0 mt-3 mb-3 text-right" action="phpmyadmin" method="post">
        <input type="submit" class="mr-2 col-5 btn btn-info" value="Php My Admin">
    </form>
    <form class="col-6 mx-auto p-0 mt-3 mb-3 text-left" action="localhost/phpinfo.php" method="post">
        <input type="submit" class="mr-2 btn col-5 btn-info" value="Php Info">
    </form>
</div>
<div class="col-8 row mx-auto m-0 p-0">
    <form class="col-6 mx-auto p-0 m-0 mb-3 text-right" action="index.php" method="get">
        <input type="search" class="col-6" name="terme" id="tags">
        <input class="mr-2 btn btn-primary col-5" type="submit" name="s" value="Rechercher">
    </form>
    <form action="index.php" class="col-6 text-left m-0 p-0" method="post">
        <input type="submit" class="btn btn-danger col-5" value="Annuler">
    </form>
</div>
<p style="color: red; font-size: 20px;" class="font-weight-bold text-center mt-3 mb-4"><?= $message ?></p>
<?php if (!isset($_GET['terme'])) {
    ?>
<table class="col-8 table-striped mx-auto">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Editer</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $folders = glob('./*', GLOB_ONLYDIR);
    foreach ($folders as $f) {
        $tmp[basename($f)] = filemtime($f);
    }
    arsort($tmp);
    $folders = array_keys($tmp);
    foreach ($folders as $folder) {
        if ($folder === '.' or $folder === '..') {
            continue;
        }
        if (is_dir($folder) && file_exists('./' . $folder . '/web/app_dev.php')) {
            ?>
                <li><span class="label label-info">Symfony</span> <a href="./<?php echo $folder . '/web/app_dev.php'; ?>"><?php echo $folder; ?></a></li>
                <?php
        } elseif (is_dir($folder)) {
            ?>
                <tr>
                    <th scope="row"><a href="<?= $folder; ?>"><?= $folder ?></a></th>
                    <td>
                        <form action="index.php" method="post">
                            <input type="text" name="newname" value="<?= $folder ?>">
                            <input type="hidden" value="<?= $folder ?>" name="projetrename">
                            <input type="submit" class="btn btn-info" value="Renommer">
                        </form>
                    </td>
                    <td>
                        <button class="displaydiv btn btn-danger">Supprimer</button>
                        <div class="display" style="display: none; height: 100vh; width: 100%; background: rgba(238, 235, 237, 0.9); position: fixed; z-index: 5555; left: 0; top: 0;">
                            <div style="background-color: white; height: 25%; border-radius: 5px; border: 1px solid black;" class="my-auto mx-auto col-5">
                                <h2 style="color: black; font-size: 20px; font-weight: bold;" class="pt-2">Supprimer réellement <?= $folder ?> ?</h2>
                                <a class="displaynonediv" href="index.php"><i class="fas fa-times fa-2x"></i></a>
                                <form action="index.php" class="text-right" style="bottom: 3px; position: absolute; right: 3px;" method="post">
                                    <input type="hidden" value="<?= $folder ?>" name="projetremove">
                                    <input type="submit" class="btn btn-danger" value="Supprimer">
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
        }
    } ?>
  </tbody>
</table>
<?php
} else {
        ?>
    <?php
    $folders = glob('./' . $_GET['terme']);
        if (file_exists($_GET['terme'])) {
            ?>
    <table class="col-8 table-striped mx-auto">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Editer</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
        <?php
        foreach ($folders as $f) {
            ?>
            <tr>
                <th scope="row"><a href="<?= $f; ?>"><?= basename($f) ?></a></th>
                <td>
                    <form action="index.php" method="post">
                        <input type="text" name="newname" value="<?= basename($f) ?>">
                        <input type="hidden" value="<?= basename($f) ?>" name="projetrename">
                        <input type="submit" class="btn btn-info" value="Renommer">
                    </form>
                </td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" value="testprojet" name="projetremove">
                        <input type="submit" class="btn btn-danger" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php
        } ?>
    </tbody>
</table>
    <?php
        } else {
            ?>
        <p style="color: red; font-size: 20px;" class="font-weight-bold text-center">Aucun fichier de ce nom n'as étais trouver</p>
    <?php
        }
    }
    ?>

<?php include './localhost/footer.php'; ?>
<script>
$(function() {
    var scriptData = '<?= json_encode($folders) ?>';
    var parseTable = JSON.parse(scriptData);
    var availableTags = [];
    var idprincipal = document.getElementById('test');
    for (let i = 0; i < parseTable.length; i++) {
        availableTags.push(parseTable[i])
    }
    $( "#tags" ).autocomplete({
        source: availableTags,
        minLength:1
    }); 
});

</script>