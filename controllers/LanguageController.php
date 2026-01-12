<?php
require_once(__DIR__ . '/../models/Language.php');

function listLanguages()
{
    $model = new Language();
    return $model->getAll();
}

function getLanguage($id)
{
    $list = listLanguages();
    foreach ($list as $item) {
        if ($item->getId() == $id) return $item;
    }
    return null;
}

function storeLanguage($name, $iso_code)
{
    $new = new Language(null, $name, $iso_code);
    return $new->store();
}

function updateLanguage($id, $name, $iso_code)
{
    $language = getLanguage($id);
    if ($language) {
        $language->setName($name);
        $language->setIsoCode($iso_code);
        return $language->update();
    }
    return false;
}

function deleteLanguage($id)
{
    $language = getLanguage($id);
    if ($language) return $language->delete();
    return false;
}
?>
