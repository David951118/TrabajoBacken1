<?php require_once('../../controllers/PlatformController.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataformas - Dashboard</title>
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
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-tv me-2"></i>Plataformas</h4>
                    <a href="create.php" class="btn btn-light text-primary btn-sm fw-bold"><i
                            class="fas fa-plus me-1"></i>Nueva Plataforma</a>
                </div>

                <div class="card-body">
                    <?php $list = listPlatforms(); ?>
                    <?php if (count($list) > 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $item) { ?>
                                        <tr>
                                            <td>#
                                                <?php echo $item->getId(); ?>
                                            </td>
                                            <td class="fw-bold">
                                                <?php echo htmlspecialchars($item->getName()); ?>
                                            </td>
                                            <td class="text-end">
                                                <a href="edit.php?id=<?php echo $item->getId(); ?>"
                                                    class="btn btn-sm btn-outline-primary me-1" title="Editar"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="delete.php" method="POST" style="display:inline"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar este elemento?');">
                                                    <input type="hidden" name="platformId"
                                                        value="<?php echo $item->getId(); ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Borrar"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-info text-center"><i class="fas fa-info-circle me-2"></i>No hay plataformas
                            registradas.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>