<?php
require_once('../../controllers/LanguageController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $isoCode = $_POST['iso_code'] ?? '';

    if (!empty($name) && !empty($isoCode)) {
        if (storeLanguage($name, $isoCode)) {
            header('Location: list.php');
            exit();
        } else {
            $error = "Error al crear el idioma.";
        }
    } else {
        $error = "Nombre y Código ISO son obligatorios.";
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
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><i
                                    class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?></div>
                        <?php endif; ?>

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
                                <button type="submit" class="btn btn-dark px-4">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>