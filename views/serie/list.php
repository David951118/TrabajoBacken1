<?php require_once('../../controllers/SerieController.php');
require_once('../../controllers/PlatformController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Series - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light">
    <?php include '../menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../../views/sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-video me-2"></i>Catálogo de Series</h4>
                    <a href="create.php" class="btn btn-light text-success btn-sm fw-bold"><i
                            class="fas fa-plus me-1"></i>Nueva Serie</a>
                </div>
                <div class="card-body">
                    <?php $list = listSeries();
                    $platforms = listPlatforms();
                    // Helper to get platform name (inefficient but simple for this activity)
                    function getPlatformName($id, $platforms)
                    {
                        foreach ($platforms as $p) {
                            if ($p->getId() == $id)
                                return $p->getName();
                        }
                        return 'Desconocida';
                    }
                    ?>
                    <?php if (count($list) > 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Plataforma</th>
                                        <th>Director ID</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $item) { ?>
                                        <tr>
                                            <td>#<?php echo $item->getId(); ?></td>
                                            <td class="fw-bold lead" style="font-size: 1.1rem;">
                                                <?php echo htmlspecialchars($item->getTitle()); ?>
                                            </td>
                                            <td><span
                                                    class="badge bg-dark"><?php echo htmlspecialchars(getPlatformName($item->getPlatformId(), $platforms)); ?></span>
                                            </td>
                                            <td><?php echo $item->getDirectorId(); ?></td>
                                            <td class="text-end">
                                                <a href="edit.php?id=<?php echo $item->getId(); ?>"
                                                    class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                                                <form action="delete.php" method="POST" style="display:inline"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar este elemento?');">
                                                    <input type="hidden" name="id" value="<?php echo $item->getId(); ?>">
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
                        <div class="alert alert-info text-center"><i class="fas fa-info-circle me-2"></i>No hay series
                            registradas.</div>
                    <?php } ?>
                </div>
            </div>
            <h4 class="mb-3 mt-4 text-secondary">Gestión de Relaciones</h4>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-start border-4 border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">
                                <i class="fas fa-user-plus me-2"></i>Reparto
                            </h5>
                            <p class="card-text text-muted small">
                                Asignar actores a series.
                            </p>
                            <a href="../series_actor/list.php"
                                class="btn btn-outline-success btn-sm w-100">Administrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-start border-4 border-info">
                        <div class="card-body">
                            <h5 class="card-title text-info">
                                <i class="fas fa-volume-up me-2"></i>Audios
                            </h5>
                            <p class="card-text text-muted small">
                                Idiomas de audio por serie.
                            </p>
                            <a href="../series_audio_language/list.php"
                                class="btn btn-outline-info btn-sm w-100">Administrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-start border-4 border-warning">
                        <div class="card-body">
                            <h5 class="card-title text-warning">
                                <i class="fas fa-closed-captioning me-2"></i>Subtítulos
                            </h5>
                            <p class="card-text text-muted small">
                                Idiomas de subtítulos por serie.
                            </p>
                            <a href="../series_subtitle_language/list.php"
                                class="btn btn-outline-warning btn-sm w-100">Administrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>