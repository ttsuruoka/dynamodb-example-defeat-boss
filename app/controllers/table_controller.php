<?php
class TableController extends AppController
{
    public function index()
    {
        $tables = TableService::all();
        Log::info($tables);
    }
}

