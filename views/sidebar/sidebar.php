<?php

$at_root = is_dir('views');

$css_path = $at_root ? 'views/sidebar/sidebar.css' : '../sidebar/sidebar.css';
$home_path = $at_root ? 'index.php' : '../../index.php';
$view_path = $at_root ? 'views/' : '../';


$current_page = $_SERVER['PHP_SELF'];
?>

<link rel="stylesheet" href="<?php echo $css_path; ?>">
<nav class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-database me-2"></i>Admin</h3>
    </div>
    <ul class="list-unstyled components">
        <li class="<?php echo strpos($current_page, 'index.php') !== false ? 'active' : ''; ?>">
            <a href="<?php echo $home_path; ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        </li>
        <li class="<?php echo strpos($current_page, 'platform/') !== false ? 'active' : ''; ?>">
            <a href="<?php echo $view_path; ?>platform/list.php"><i class="fas fa-tv me-2"></i>Plataformas</a>
        </li>
        <li class="<?php echo strpos($current_page, 'serie/') !== false ? 'active' : ''; ?>">
            <a href="<?php echo $view_path; ?>serie/list.php"><i class="fas fa-film me-2"></i>Series</a>
        </li>
        <li class="<?php echo strpos($current_page, 'director/') !== false ? 'active' : ''; ?>">
            <a href="<?php echo $view_path; ?>director/list.php"><i class="fas fa-chair me-2"></i>Directores</a>
        </li>
        <li class="<?php echo strpos($current_page, 'actor/') !== false ? 'active' : ''; ?>">
            <a href="<?php echo $view_path; ?>actor/list.php"><i class="fas fa-user-friends me-2"></i>Actores</a>
        </li>
        <li class="<?php echo strpos($current_page, 'language/') !== false ? 'active' : ''; ?>">
            <a href="<?php echo $view_path; ?>language/list.php"><i class="fas fa-language me-2"></i>Idiomas</a>
        </li>
    </ul>
</nav>