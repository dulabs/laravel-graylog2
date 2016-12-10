<?php namespace Dulabs\Graylog2;

use Monolog\Handler\AbstractHandler;

class Graylog2Handler extends AbstractHandler
{
    /**
     * Handle the log record.
     *
     * @param array $record
     *
     * @return bool
     */

    public function handle(array $record = [])
    {
        // Do something with the $record array
        try {
            $graylog2 = app('graylog2');

            $message = $record['message'];

            $loglevel = strtolower($record['level_name']);

            $graylog2->{$loglevel}($message);
        } catch (Exception $e) {
            Log::error("cannot log error to graylog");
        }
    }
}