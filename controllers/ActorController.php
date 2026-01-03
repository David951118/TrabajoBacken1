<?php
require_once(__DIR__ . '/../models/Actor.php');

function listActors()
{
    $model = new Actor();
    return $model->getAll();
}

function getActor($id)
{
    $list = listActors();
    foreach ($list as $item) {
        if ($item->getId() == $id) return $item;
    }
    return null;
}

function storeActor($first_name, $last_name, $birth_date, $nationality)
{
    $new = new Actor(null, $first_name, $last_name, $birth_date, $nationality);
    return $new->store() ? $new : false;
}

function updateActor($id, $first_name, $last_name, $birth_date, $nationality)
{
    $actor = getActor($id);
    if ($actor) {
        $actor->setFirstName($first_name);
        $actor->setLastName($last_name);
        $actor->setBirthDate($birth_date);
        $actor->setNationality($nationality);
        return $actor->update();
    }
    return false;
}

function deleteActor($id)
{
    $actor = getActor($id);
    if ($actor) return $actor->delete();
    return false;
}
?>