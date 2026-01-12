<?php
require_once('../../controllers/LanguageController.php');

$sendData = false;
$languageCreated = false;

if (isset($_POST['createBtn'])) {
    $sendData = true;
}

if ($sendData) {
    $name = $_POST['name'] ?? '';
    $isoCode = $_POST['iso_code'] ?? '';

    if (!empty($name) && !empty($isoCode)) {
        $languageCreated = storeLanguage($name, $isoCode);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Idioma - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light">
    <?php include '../menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="row justify-content-center">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nuevo Idioma</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!$sendData) { ?>
                        <form method="POST" action="create.php">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nombre del Idioma</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ej: Español"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="iso_code" class="form-label fw-bold">Código ISO</label>
                                <input type="text" class="form-control" id="iso_code" name="iso_code"
                                    placeholder="Ej: es" maxlength="2" required>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" name="createBtn" class="btn btn-dark px-4">Guardar</button>
                            </div>
                        </form>
                        <?php } else { ?>
                            <?php if ($languageCreated) { ?>
                                <div class="alert alert-success" role="alert">
                                    Idioma creado correctamente.<br>
                                    <a href="list.php">Volver al listado de idiomas.</a>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    El idioma no se ha creado correctamente.<br>
                                    <a href="create.php">Volver a intentarlo.</a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>