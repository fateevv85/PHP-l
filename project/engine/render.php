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

    if (is_array($template)) {
        foreach ($template as $value) {
            include TEMPLATES_DIR . "/{$value}";
        }
    } else {
        include TEMPLATES_DIR . "/{$template}";
    }

    return ob_get_clean();
}
