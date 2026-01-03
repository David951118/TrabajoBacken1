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
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.html"><i class="fas fa-film me-2"></i>BBDD Series</a>
            <a href="../../index.html" class="btn btn-outline-light btn-sm"><i class="fas fa-home me-1"></i>Inicio</a>
        </div>
    </nav>
    <div class="container pb-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-video me-2"></i>Catálogo de Series</h4>
                <a href="create.php" class="btn btn-light text-success btn-sm fw-bold"><i class="fas fa-plus me-1"></i>Nueva Serie</a>
            </div>
            <div class="card-body">
                <?php $list = listSeries(); 
                      $platforms = listPlatforms(); 
                      // Helper to get platform name (inefficient but simple for this activity)
                      function getPlatformName($id, $platforms) {
                          foreach($platforms as $p) { if($p->getId() == $id) return $p->getName(); }
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
                                        <td class="fw-bold lead" style="font-size: 1.1rem;"><?php echo htmlspecialchars($item->getTitle()); ?></td>
                                        <td><span class="badge bg-dark"><?php echo htmlspecialchars(getPlatformName($item->getPlatformId(), $platforms)); ?></span></td>
                                        <td><?php echo $item->getDirectorId(); ?></td>
                                        <td class="text-end">
                                            <a href="edit.php?id=<?php echo $item->getId(); ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                                            <form action="delete.php" method="POST" style="display:inline" onsubmit="return confirm('¿Seguro que deseas eliminar este elemento?');">
                                                <input type="hidden" name="id" value="<?php echo $item->getId(); ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info text-center"><i class="fas fa-info-circle me-2"></i>No hay series registradas.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
