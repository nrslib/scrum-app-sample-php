<?php


namespace Lib\Transaction;


use Basic\Transaction\Transaction;
use Illuminate\Support\Facades\DB;

class LaravelDbTransaction implements Transaction
{
    function scope(callable $transactionScope)
    {
        DB::transaction($transactionScope);
    }

    function begin()
    {
        DB::beginTransaction();
    }

    function commit()
    {
        DB::commit();
    }

    function rollback()
    {
        DB::rollBack();
    }
}
