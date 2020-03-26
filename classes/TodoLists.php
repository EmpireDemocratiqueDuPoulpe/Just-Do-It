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
            'SELECT list_id, name, color FROM todo_lists WHERE user_id = :user_id ORDER BY list_id',
            ["user_id" => (int) $user_id]
        );
    }

    /**
     * Get a todo list.
     *
     * This function get a todo list by is id and owned
     * by a user.
     *
     * @function    get
     * @access      public
     * @param       int|string      $user_id    User id
     * @param       int|string      $list_id    List id
     * @return      array|string
     */
    public function get($user_id, $list_id) {

        return PDOFactory::sendQuery(
            $this->_db,
            'SELECT name, color FROM todo_lists WHERE user_id = :user_id AND list_id = :list_id',
            ["user_id" => (int) $user_id, "list_id" => (int) $list_id]
        );
    }

    /**
     * Add a todo list.
     *
     * This function take the new todo list name, the
     * user id and the base color and add it into the
     * database.
     *
     * @function    add
     * @access      public
     * @param       string          $title    Title of the todo list
     * @param       int             $user_id  User id who own this list
     * @param       string          $color    Base color of the todo list
     * @return      boolean
     */
    public function add($title, $user_id, $color) {

        // Get last ID before query
        $lastIDBefore = PDOFactory::sendQuery($this->_db, 'SELECT list_id FROM todo_lists ORDER BY list_id DESC LIMIT 1')[0]["list_id"];

        // Add todo list
        PDOFactory::sendQuery(
            $this->_db,
            'INSERT INTO todo_lists(user_id, name, color) VALUES (:user_id, :name, :color)',
            ["user_id" => (int) $user_id, "name" => $title, "color" => $color],
            false
        );

        // Get last ID after query
        $lastIDAfter = PDOFactory::sendQuery($this->_db, 'SELECT list_id FROM todo_lists ORDER BY list_id DESC LIMIT 1')[0]["list_id"];

        // Return result
        return $lastIDBefore !== $lastIDAfter;
    }

    /**
     * Delete a todo list.
     *
     * This function take the todo list id and delete
     * it from the database.
     *
     * @function    delete
     * @access      public
     * @param       int             $list_id  List id targeted for deletion
     * @return      boolean
     */
    public function delete($list_id) {

        // Delete todo list
        PDOFactory::sendQuery(
            $this->_db,
            'DELETE FROM todo_lists WHERE list_id = :list_id',
            ["list_id" => (int) $list_id],
            false
        );

        // Return result
        return (bool) PDOFactory::sendQuery($this->_db, 'SELECT list_id FROM todo_lists WHERE list_id = :list_id', ["list_id" => $list_id]);
    }
}