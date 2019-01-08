<?php
function checkLogined()
{
    if (isset($_SESSION['login']) and $_SESSION['login'] == true)
        return true;
    return false;
}

if (!function_exists('redirect')) {
    function redirect($url, $permanent = false)
    {
        header('Location: ' . base_path($url), true, $permanent ? 301 : 302);

        exit();
    }
}

if (!checkLogined())
    redirect("login.php", true);