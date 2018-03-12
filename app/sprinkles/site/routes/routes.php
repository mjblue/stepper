<?php

$app->get('/steps', 'UserFrosting\Sprinkle\Site\Controller\PageController:pageSteps')
    ->add('authGuard');

    $app->post('/steps/add', 'UserFrosting\Sprinkle\Site\Controller\PageController:addSteps')
    ->add('authGuard');