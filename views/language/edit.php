<?php
require_once('../../controllers/LanguageController.php');

$id = $_GET['id'] ?? null;
$language = null;

if ($id) {
    $language = getLanguageById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $isoCode = $_POST['iso_code'] ?? '';

    if (!empty($name) && !empty($isoCode) && $id) {
        if (updateLanguage($id, $name, $isoCode)) {
            header('Location: list.php');
            exit();
        } else {
            $error = "Error al actualizar el idioma.";
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
    <title>Editar Idioma - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.html"><i class="fas fa-film me-2"></i>BBDD Series</a>
            <a href="../../index.html" class="btn btn-outline-light btn-sm"><i class="fas fa-home me-1"></i>Inicio</a>
        </div>
    </nav>
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                     <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Idioma</h4>
                    </div>
                    <div class="card-body">
                         <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?></div>
                        <?php endif; ?>

                        <?php if ($language): ?>
                        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                            <input type="hidden" name="id" value="<?php echo $language->getId(); ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nombre del Idioma</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($language->getName()); ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="iso_code" class="form-label fw-bold">Código ISO</label>
                                <input type="text" class="form-control" id="iso_code" name="iso_code" value="<?php echo htmlspecialchars($language->getIsoCode()); ?>" maxlength="2" required>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-dark px-4">Actualizar</button>
                            </div>
                        </form>
                         <?php else: ?>
                            <div class="alert alert-warning">Idioma no encontrado.</div>
                            <a href="list.php" class="btn btn-secondary">Volver</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
