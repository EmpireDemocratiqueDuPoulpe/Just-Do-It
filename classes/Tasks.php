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
     * but not the shared ones. It use the user_id and
     * return an array.
     *
     * @function    getAll
     * @access      public
     * @param       int|string      $user_id    User id
     * @return      array|string
     */
    public function getAll($user_id) {

        return PDOFactory::sendQuery(
            $this->_db,
            "SELECT task_id, list_id, name, status FROM tasks WHERE user_id = :user_id",
            ["user_id" => (int) $user_id]
        );
    }
}