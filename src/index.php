<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json");
require_once 'db.php';
require_once 'Controller/TaskController.php';

$taskController = new TaskController($pdo);
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/tasks' && $method === 'GET') {
    // Get all tasks
    $taskController->getTasks();
} else if (preg_match('/\/tasks\/(\d+)/', $uri, $matches) && $method === 'GET') {
    // Get a specific task
    $taskId = $matches[1];
    $taskController->getTask($taskId);
} elseif ($uri === '/tasks' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $taskController->createTask($data);
} elseif (preg_match('/\/tasks\/(\d+)/', $uri, $matches) && $method === 'DELETE') {
    // Delete a task
    $taskId = $matches[1];
    $taskController->deleteTask($taskId);
} elseif (preg_match('/\/tasks\/(\d+)/', $uri, $matches) && $method === 'PUT') {
    // Update a task
    $taskId = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $taskController->updateTask($taskId, $data);
}
else {
    // Handle other methods or routes
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
    exit;
}
