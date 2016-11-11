<?php
/**
 * Created by PhpStorm.
 * User: Iruka Avantha
 * Date: 10/30/2016
 * Time: 1:32 AM
 */

// Client Breadcrumbs

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', '/home');
});

// Home > Profile
Breadcrumbs::register('profile', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('MyProfile', '/my-profile/'.$id);
});
// Home > Profile > edit
Breadcrumbs::register('edit', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('profile',$id);
    $breadcrumbs->push('edit','/my-profile/'.$id.'/edit');
});

// Home > Template Store
Breadcrumbs::register('store', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profiler.Net Store', '/temp_store');
});
// Home > Template Store > My Orders
Breadcrumbs::register('pending', function($breadcrumbs)
{
    $breadcrumbs->parent('store');
    $breadcrumbs->push('Myorders', '/preorder/pending');
});

// Home  > Template Store >My Orders> Order
Breadcrumbs::register('recipt', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('pending');
    $breadcrumbs->push('Order Recipt', '/preorder/show/'.$id);
});


// Home  > My Gallery
Breadcrumbs::register('gallery', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Gallery', '/gallery/list');
});

// Home  > My Gallery > Album
Breadcrumbs::register('album', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('gallery');
    $breadcrumbs->push('Album Photos', '/gallery/view/'.$id);
});




//Admins BreadCrumbs
// admin Home
Breadcrumbs::register('admin-home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', '/admin/home');
});

//aDmin Home  >Reports
Breadcrumbs::register('reports', function($breadcrumbs)
{
    $breadcrumbs->parent('admin-home');
    $breadcrumbs->push('Reports', '/reports');
});


//aDmin Home  >Reports> Order details
Breadcrumbs::register('Temp-reports', function($breadcrumbs)
{
    $breadcrumbs->parent('reports');
    $breadcrumbs->push('Template Order Detials', '/preorder/reports');
});



//aDmin Home  >Reports> Login log
Breadcrumbs::register('login-log', function($breadcrumbs)
{
    $breadcrumbs->parent('reports');
    $breadcrumbs->push('Login Log ', '/admin/logs/login');
});