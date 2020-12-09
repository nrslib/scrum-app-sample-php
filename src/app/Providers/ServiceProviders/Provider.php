<?php


namespace App\Providers\ServiceProviders;


use Illuminate\Foundation\Application;

interface Provider
{
    function register();
    function boot();
}
