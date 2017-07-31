<?php

// view and string http responses
// status code = 200 Content-Type = text/html
// we could also check if a string contains html, 
// if it does not send back text/plain

route::get ( '/', function ( view $view )
{
    return $view->make ( 'overview' );
} );





// redirect http responses
// status code set by the redirector.

route::post ( '/exercises', function ( app $app )
{
    return $app->fulfill ( 'i want to add an exercise' );             
} );

// 1 successfully added exercise
use function compact as with;

status::match ( 1, function ( exercise $exercise, notifier $notifier, redirector $redirect )
{
    $notifier->notify ( 'exercise added', with ( 'exercise' ) );
    return $redirect->back ( 303 );
} );

use function compact as concerning;

// 2 exercise exicise exists
status::match ( 2, function ( exercise $exercise, notifier $notifier, redirector $redirect )
{
    $notifier->notify ( 'exercise exists', concerning ( 'exercise' ) );
    return $redirect->back ( 303 );
} );