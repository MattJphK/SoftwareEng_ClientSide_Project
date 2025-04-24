<?php global $dsn, $username, $password, $options;
require_once __DIR__ . '/../data/config.php';
try {
    $connection = new PDO($dsn, $username, $password, $options);
    echo 'DB connected ';
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>