<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de Administración - Streaming DB</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="index.css">
</head>

<body>
  <?php include 'views/menu/menu.php'; ?>

  <div class="wrapper">
    <!-- Sidebar -->
    <?php include 'views/sidebar/sidebar.php'; ?>

    <!-- Page Content -->
    <div class="content">
      <h2 class="mb-4 text-dark border-bottom pb-2">
        Panel de Control Principal
      </h2>

      <div class="row">
        <!-- Entidades Principales -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card dashboard-card bg-gradient-primary">
            <a href="./views/platform/list.php">
              <div class="card-body text-center">
                <div class="card-icon"><i class="fas fa-tv"></i></div>
                <h5>Plataformas</h5>
                <button class="btn btn-light btn-sm mt-2 text-primary fw-bold">Gestionar</button>
              </div>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card dashboard-card bg-gradient-success">
            <a href="./views/serie/list.php">
              <div class="card-body text-center">
                <div class="card-icon"><i class="fas fa-film"></i></div>
                <h5>Series</h5>
                <button class="btn btn-light btn-sm mt-2 text-success fw-bold">Gestionar</button>
              </div>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card dashboard-card bg-gradient-info">
            <a href="./views/director/list.php">
              <div class="card-body text-center">
                <div class="card-icon"><i class="fas fa-user-tie"></i></div>
                <h5>Directores</h5>
                <button class="btn btn-light btn-sm mt-2 text-info fw-bold">Gestionar</button>
              </div>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card dashboard-card bg-gradient-warning">
            <a href="./views/actor/list.php">
              <div class="card-body text-center">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <h5>Actores</h5>
                <button class="btn btn-light btn-sm mt-2 text-warning fw-bold">Gestionar</button>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>