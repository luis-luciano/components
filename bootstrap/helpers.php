<?php

/**
 * Load the indicated view
 *
 * @param string $template
 * @param array $vars
 * @return void
 */
function view(string $template, array $vars = [])
{
    extract($vars);

    $path = __DIR__ . '/../views/';

    ob_start();

    require("{$path}{$template}.php");

    // Get the value of template
    $templateContent = ob_get_clean();

    require("{$path}layout.php");
}
