<?php


namespace App\Providers\ServiceProviders;


interface Provider
{
    function register();

    function boot();
}
