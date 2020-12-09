<?php


namespace Basic\Transaction;


interface Transaction
{
    /**
     * @param callable $transactionScope
     * @return mixed
     */
    function scope(callable $transactionScope): ?object;
    function begin();
    function commit();
    function rollback();
}
