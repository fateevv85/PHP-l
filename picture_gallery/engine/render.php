<?php
include_once ENGINE_DIR . "/db.php";

function renderLayout($template, $params = [], $useLayout = true)
{
    $content = renderTemplate($template, $params);
    if ($useLayout) {
        $content = renderTemplate('layouts/mainLayout.php', ['content' => $content]);
    }
    return $content;
}

function renderTemplate($template, $params = [])
{
    ob_start();
    extract($params);
    include TEMPLATES_DIR . "/{$template}";
    return ob_get_clean();
}
