<?php

namespace Mubasharkk\Oxid\Helpers;

final class ColorizeCLI
{
    public const ESC = "\033";

    public const ANSI_CLOSE = self::ESC."[0m";

    public const ANSI_BOLD = self::ESC."[1m";

    public const ANSI_UNDERLINE = self::ESC."[4m";

    public static function success(string $msg): void
    {
        echo "\033[32m{$msg} \033[0m\n";
    }

    public static function warning(string $msg): void
    {
        echo "\033[33m{$msg} \033[0m\n";
    }

    public static function info(string $msg): void
    {
        echo "\033[36m{$msg} \033[0m\n";
    }

    public static function error(string $msg): void
    {
        echo "\033[31m{$msg} \033[0m\n";
    }

    public static function textBold(string $text): string
    {
        return self::ANSI_UNDERLINE.self::ANSI_BOLD.$text.self::ANSI_CLOSE.PHP_EOL;
    }
}
