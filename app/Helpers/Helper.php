<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Schema;

class Helper
{
    /**
     * check if column exists in table
     *
     * @param string $table,
     * @param string $column
     * @return bool
     */
    public static function hasColumnInTable(string $table, string $column): bool
    {
        if (Schema::hasColumn($table, $column)) //check the column
        {
            return true;
        }
        return false;

    }
}
