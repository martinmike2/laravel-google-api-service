<?php namespace Fuelingbrands\GoogleApiClient\Logger;

class LaravelLogger implements LoggerInterface
{

    public static function info($message)
    {
        \Log::info($message);
    }

    public static function warning($message)
    {
        \Log::warning($message);
    }

    public static function error($message)
    {
        \Log::error($message);
    }
}