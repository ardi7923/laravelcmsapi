<?php

namespace Ardi7923\Laravelcmsapi\Traits;

use DB;

trait OptimizationTool
{
    protected function startLogExecutionTime($name='OptimizationTool_START_TIME')
    {
        $GLOBALS[$name] = microtime(true);
    }

    protected function printQueriesLog()
    {
        $queries = DB::getQueryLog();

        echo "QUERY LOG\n\n";
        foreach ($queries as $q) {
            echo $q['time'] . " --- ".$q['query']."\n";
        }
    }

    protected function printExecutionTime($title="", $name='OptimizationTool_START_TIME')
    {
        if (!isset($GLOBALS[$name])) {
            return false;
        }

        $end_time = microtime(true);
        $execution_time = ($end_time - $GLOBALS[$name]);

        echo "$title = ".$execution_time." sec\n";

        $GLOBALS[$name] = microtime(true);
    }

    public static function getExecutionTime($name='LARAVEL_START')
    {

        $end_time = microtime(true);
        $execution_time = ($end_time - LARAVEL_START);
        $execution_time = round($execution_time, 2);

        $GLOBALS[$name] = microtime(true);

        return $execution_time." sec";
    }
}
