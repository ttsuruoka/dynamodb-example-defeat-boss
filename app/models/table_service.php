<?php
class TableService
{
    public static function all()
    {
        $db = Dynamo::conn();
        $r = $db->call('ListTables');

        return $r;
    }
}
