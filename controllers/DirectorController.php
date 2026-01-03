<?php
require_once(__DIR__ . '/../models/Director.php');

function listDirectors()
{
    $model = new Director();
    return $model->getAll();
}

function getDirector($id)
{
    $list = listDirectors();
    foreach ($list as $item) {
        if ($item->getId() == $id) return $item;
    }
    return null;
}

function storeDirector($first_name, $last_name, $birth_date, $nationality)
{
    $new = new Director(null, $first_name, $last_name, $birth_date, $nationality);
    return $new->store() ? $new : false;
}

function updateDirector($id, $first_name, $last_name, $birth_date, $nationality)
{
    $director = getDirector($id);
    if ($director) {
        $director->setFirstName($first_name);
        $director->setLastName($last_name);
        $director->setBirthDate($birth_date);
        $director->setNationality($nationality);
        return $director->update();
    }
    return false;
}

function deleteDirector($id)
{
    $director = getDirector($id);
    if ($director) return $director->delete();
    return false;
}
?>
