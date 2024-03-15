<?php

use Mubasharkk\Oxid\Helpers\ColorizeCLI;

require_once './vendor/autoload.php';


try {
    $str = "Welcome!";

    ColorizeCLI::success($str);
    throw new \Exception('This is warning!');
} catch (\Exception $ex) {
    ColorizeCLI::warning($ex->getMessage());
} catch (\Error $err) {
    ColorizeCLI::error($err->getMessage());
}
