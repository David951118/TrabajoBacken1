<?php require_once('../../controllers/SeriesSubtitleLanguageController.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subtítulos - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light">
    <?php include '../menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-closed-captioning me-2"></i>Series - Subtítulos</h4>
                    <a href="create.php" class="btn btn-dark btn-sm fw-bold"><i class="fas fa-plus me-1"></i>Asignar
                        Subtítulo</a>
                </div>
                <div class="card-body">
                    <?php $list = listSeriesSubtitleLanguages(); ?>
                    <?php if (count($list) > 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Serie ID</th>
                                        <th>Language ID</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $item) { ?>
                                        <tr>
                                            <td><span class="badge bg-success">Serie #<?php echo $item->getSeriesId(); ?></span>
                                            </td>
                                            <td><span class="badge bg-secondary">Idioma
                                                    #<?php echo $item->getLanguageId(); ?></span></td>
                                            <td class="text-end">
                                                <form action="delete.php" method="POST" style="display:inline"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta relación?');">
                                                    <input type="hidden" name="series_id"
                                                        value="<?php echo $item->getSeriesId(); ?>">
                                                    <input type="hidden" name="language_id"
                                                        value="<?php echo $item->getLanguageId(); ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-info text-center"><i class="fas fa-info-circle me-2"></i>No hay asignaciones
                            registradas.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
</body>

</html>