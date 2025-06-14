<?php

$isScssconverted = false;

require_once("../scssphp/scss.inc.php");

use ScssPhp\ScssPhp\Compiler;

if ($isScssconverted) {

    global $compiler;
    $compiler = new Compiler();

    $compine_css = "../assets/css/app.min.css";

    $source_scss = "../assets/scss/config/galaxy/app.scss";

    $scssContents = file_get_contents($source_scss);

    $import_path = "../assets/scss/config/galaxy";
    $compiler->addImportPath($import_path);
    $target_css = $compine_css;

    $css = $compiler->compileString($scssContents);

    if (!empty($css) && is_string($css)) {
        file_put_contents($target_css, $css);
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lng ?>" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1" data-preloader="disable">