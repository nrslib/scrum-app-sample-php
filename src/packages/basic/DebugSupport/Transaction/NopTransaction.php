<?php


namespace Basic\DebugSupport\Transaction;


use Basic\Transaction\Transaction;

class NopTransaction implements Transaction
{

    function scope(callable $transactionScope): ?object
    {
        return $transactionScope();
    }

    function begin()
    {
    }

    function commit()
    {
    }

    function rollback()
    {
    }
}
