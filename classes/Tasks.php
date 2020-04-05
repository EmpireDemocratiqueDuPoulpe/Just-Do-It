<?php

/**
 * Tasks provide several methods to work with tasks
 * of todo lists.
 *
 * Tasks provide methods to get task of a user, to
 * add or delete one, etc...
 *
 * Example:
 * $TasksManager = new Tasks();
 * $tasks = $TasksManager->getAll($user_id);
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
class Tasks {

    /** Attributes
     * @var     PDO     PDO Object connected to the database
     */
    private $_db;

    /**
     * Tasks constructor.
     *
     * @function    __construct
     * @access      public
     * @param       PDO         $db     PDO Object connected to the database
     * @return      void
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
    }

    /**
     * Get tasks of user.
     *
     * This function get every tasks owned by a user
     * but not the shared ones. It use the user id and
     * return an array.
     *
     * @function    getAll
     * @access      public
     * @param       int|string      $user_id    User id
     * @return      array|string    Array of tasks or an error.
     */
    public function getAll($user_id) {

        return PDOFactory::sendQuery(
            $this->_db,
            'SELECT task_id, list_id, name, status FROM tasks WHERE user_id = :user_id',
            ["user_id" => (int) $user_id]
        );
    }

    /**
     * Get tasks of list.
     *
     * This function get every tasks owned by a user
     * and contained in the list. It use the user id
     * and the list id to return an array. If the type
     * is not defined, it will return every tasks.
     *
     * @function    get
     * @access      public
     * @param       int|string      $user_id    User id
     * @param       int|string      $list_id    List id
     * @param       string          $type       (optional) Type of task: ongoing|finished
     * @return      array|string    Array of tasks or an error.
     */
    public function get($user_id, $list_id, $type = "") {
        // Prepare SQL and vars
        $sql = 'SELECT task_id, name, status FROM tasks WHERE user_id = :user_id && list_id = :list_id';
        $vars = ["user_id" => (int) $user_id, "list_id" => (int) $list_id];

        // Add a check if only on type is wanted
        if ($type == "ongoing") {
            $sql .= ' && status = :status';
            $vars["status"] = 0;
        } else if ($type == "finished") {
            $sql .= ' && status = :status';
            $vars["status"] = 1;
        }

        // Add the ORDER BY
        $sql .= " ORDER BY list_id";

        return PDOFactory::sendQuery($this->_db, $sql, $vars);
    }

    /**
     * Add a task.
     *
     * This function take the new task name, the user
     * id and the status and add it into the database.
     *
     * @function    add
     * @access      public
     * @param       int|string      $user_id    User id who own this task
     * @param       int|string      $list_id    List id
     * @param       string          $name       Task name
     * @param       string          $status     Status of the task
     * @return      boolean
     */
    public function add($user_id, $list_id, $name, $status) {

        // Get last ID before query
        $lastIDBefore = PDOFactory::sendQuery($this->_db, 'SELECT task_id FROM tasks ORDER BY task_id DESC LIMIT 1')[0]["task_id"];

        // Add todo list
        PDOFactory::sendQuery(
            $this->_db,
            'INSERT INTO tasks(user_id, list_id, name, status) VALUES (:user_id, :list_id, :name, :status)',
            ["user_id" => (int) $user_id, "list_id" => (int) $list_id, "name" => $name, "status" => $status],
            false
        );

        // Get last ID after query
        $lastIDAfter = PDOFactory::sendQuery($this->_db, 'SELECT task_id FROM tasks ORDER BY task_id DESC LIMIT 1')[0]["task_id"];

        // Return result
        return $lastIDBefore !== $lastIDAfter;
    }

    /**
     * Update a task status.
     *
     * Change the status of a task with the new status
     * (0: ongoing, 1: finished).
     *
     * @function    changeStatus
     * @access      public
     * @param       int|string      $task_id    Task id targeted
     * @param       int|string      $newStatus  Task's new status (0/1)
     * @return      boolean
     */
    public function changeStatus($task_id, $newStatus) {
        // Change task status
        PDOFactory::sendQuery(
            $this->_db,
            'UPDATE tasks SET status = :status WHERE task_id = :task_id',
            ["status" => (int) $newStatus, "task_id" => (int) $task_id],
            false
        );

        // Return result
        return (bool) PDOFactory::sendQuery(
            $this->_db,
            'SELECT task_id FROM tasks WHERE task_id = :task_id AND status = :status',
            ["task_id" => $task_id, "status" => $newStatus]
        );
    }

    /**
     * Delete a task.
     *
     * This function take the task id and delete
     * it from the database.
     *
     * @function    delete
     * @access      public
     * @param       int|string      $task_id  Task id targeted for deletion
     * @return      boolean
     */
    public function delete($task_id) {
        // Delete task
        PDOFactory::sendQuery(
            $this->_db,
            'DELETE FROM tasks WHERE task_id = :task_id',
            ["task_id" => (int) $task_id],
            false
        );

        // Return result
        return (bool) PDOFactory::sendQuery($this->_db, 'SELECT task_id FROM tasks WHERE task_id = :task_id', ["task_id" => $task_id]);
    }
}