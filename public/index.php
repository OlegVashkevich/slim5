<?php

$app = require __DIR__ . '/../bootstrap/bootstrap.php';

// Add middleware (New: FIFO by default)
(require __DIR__ . '/../bootstrap/middlewares.php')($app);

(require __DIR__ . '/../bootstrap/routes.php')($app);

// Run the app
$app->run();
