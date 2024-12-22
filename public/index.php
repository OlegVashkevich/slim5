<?php

$app = require __DIR__ . '/../bootstrap/bootstrap.php';

// Add middleware (New: FIFO by default)
(require APP_ROOT . '/bootstrap/middlewares.php')($app);

(require APP_ROOT . '/bootstrap/routes.php')($app);

// Run the app
$app->run();
