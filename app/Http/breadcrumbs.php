<?php
/**
 * Created by PhpStorm.
 * User: Iruka Avantha
 * Date: 10/30/2016
 * Time: 1:32 AM
 */


// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', '/home');
});

// Home > About
Breadcrumbs::register('profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('MyProfile', 'profile');
});