<?php


namespace Basic\Transaction;


interface Transaction
{
    function scope(callable $transactionScope);
    function begin();
    function commit();
    function rollback();
}
