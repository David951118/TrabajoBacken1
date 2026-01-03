<?php
require_once('../../controllers/SeriesSubtitleLanguageController.php');
require_once('../../controllers/SerieController.php');
require_once('../../controllers/LanguageController.php');

$series = listSeries();
$languages = listLanguages();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_id = $_POST['series_id'] ?? '';
    $language_id = $_POST['language_id'] ?? '';
    if (!empty($series_id) && !empty($language_id)) {
        $result = storeSeriesSubtitleLanguage($series_id, $language_id);
        if ($result) { header('Location: list.php'); exit(); }
        else { $error = "Error al asignar subtítulos."; }
    } else { $error = "Todos los campos son obligatorios."; }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asignar Subtítulos - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="../../index.html">Biblioteca de Series</a>
            <a href="../../index.html" class="btn btn-outline-light btn-sm"><i class="fas fa-home"></i> Inicio</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Asignar Subtítulo a Serie</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                        <form method="POST" action="create.php">
                            <div class="mb-3">
                                <label class="form-label">Serie</label>
                                <select name="series_id" class="form-select" required>
                                    <option value="" disabled selected>Seleccione Serie...</option>
                                    <?php foreach ($series as $serie): ?>
                                        <option value="<?php echo $serie->getId(); ?>"><?php echo htmlspecialchars($serie->getTitle()); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Idioma</label>
                                <select name="language_id" class="form-select" required>
                                    <option value="" disabled selected>Seleccione Idioma...</option>
                                    <?php foreach ($languages as $lang): ?>
                                        <option value="<?php echo $lang->getId(); ?>"><?php echo htmlspecialchars($lang->getName()); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-warning">Asignar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
