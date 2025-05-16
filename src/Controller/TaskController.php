<?php

require_once 'db.php';

class TaskController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTasks()
    {
        $stmt = $this->pdo->query('SELECT * FROM tasks');
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tasks);
    }

    public function getTask($taskId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$taskId]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($task) {
            echo json_encode($task);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Task not found']);
        }
    }

    public function createTask($task)
    {
        $stmt = $this->pdo->prepare('INSERT INTO tasks (name, description) VALUES (?, ?)');
        $stmt->execute([$task['name'], $task['description']]);
        echo json_encode(['status' => 'success']);
    }

    public function updateTask($taskId, $task)
    {
        $stmt = $this->pdo->prepare('UPDATE tasks SET name = ?, description = ? WHERE id = ?');
        $stmt->execute([$task['name'], $task['description'], $taskId]);
        echo json_encode(['status' => 'success update']);
    }

    public function deleteTask($taskId)
    {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->execute([$taskId]);
        echo json_encode(['status' => 'success delete']);
    }
}
