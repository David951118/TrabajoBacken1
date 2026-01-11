<?php
$at_root = is_dir('views');
$home_path = $at_root ? 'index.php' : '../../index.php';
$languages_path = $at_root ? 'views/language/list.php' : '../../views/language/list.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1 ms-3" href="<?php echo $home_path; ?>">
            <i class="fas fa-video me-2"></i>Sistema de Gestión de Contenido
        </a>
        <div class="text-center">
            <a href="<?php echo $languages_path; ?>" class="navbar-dark"><i class="fas fa-globe me-2"></i>Idiomas
                Globales</a>
        </div>
    </div>
</nav>