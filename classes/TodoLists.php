<?php

/**
 * TodoLists provide several methods to work with.
 *
 * TodoLists provide methods to get a specific todo list,
 * every todo list, to add or delete one, etc...
 *
 * Example:
 * $TodoListsManager = new TodoLists();
 * $todo_lists = $TodoListsManager->getAll($user_id);
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
class TodoLists {

    /** Attributes
     * @var     PDO     PDO Object connected to the database
     */
    private $_db;

    /**
     * TodoLists constructor.
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
     * Get todo lists of user.
     *
     * This function get every todo list owned by a user
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
            "SELECT list_id, name, color FROM todo_lists WHERE user_id = :user_id",
            ["user_id" => (int) $user_id]
        );
    }
}