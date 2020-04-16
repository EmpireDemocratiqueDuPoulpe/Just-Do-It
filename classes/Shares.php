<?php

/**
 * Shares provide several methods to work with lists
 * shares to friends.
 *
 * Example:
 * $SharesManager = new Shares($db);
 * $shares = $SharesManager->getAll($list_id);
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
class Shares {
    /** Attributes
     * @var     PDO     PDO Object connected to the database
     */
    private $_db;

    /**
     * Shares constructor.
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
     * Get shared users of a list.
     *
     * This function get every friends who have
     * been added in a shared list.
     *
     * @function    getAll
     * @access      public
     * @param       int|string      $list_id    List id
     * @return      array|string    Array of shares or an error.
     */
    public function getAll($list_id) {

        // Get users who have been added to the list
        return PDOFactory::sendQuery(
            $this->_db,
            'SELECT
                    us.user_id,
                    us.username,
                    sh.accepted
                FROM
                    todo_lists_share sh
                JOIN
                    users us ON sh.user_id = us.user_id
                WHERE
                    sh.list_id = :list_id',
            ["list_id" => (int) $list_id]
        );
    }

    /**
     * Add a share.
     *
     * This function take the list id and the friend
     * id and create a new share.
     *
     * @function    add
     * @access      public
     * @param       int|string      $list_id            User id
     * @param       int|string      $friend_id          ID of the friend
     * @return      boolean
     */
    public function add($list_id, $friend_id) {

        // Get last ID before query
        $lastIDBefore = PDOFactory::sendQuery($this->_db, 'SELECT share_id FROM todo_lists_share ORDER BY share_id DESC LIMIT 1')[0]["share_id"];

        // Create the share
        PDOFactory::sendQuery(
            $this->_db,
            'INSERT INTO todo_lists_share(list_id, user_id, accepted) VALUES (:list_id, :user_id, 0)',
            ["list_id" => (int) $list_id, "user_id" => (int) $friend_id],
            false
        );

        // Get last ID after query
        $lastIDAfter = PDOFactory::sendQuery($this->_db, 'SELECT share_id FROM todo_lists_share ORDER BY share_id DESC LIMIT 1')[0]["share_id"];

        // Return result
        return $lastIDBefore !== $lastIDAfter;
    }

    /**
     * Accept a share.
     *
     * This function take the list id and the friend
     * id and accept share.
     *
     * @function    accept
     * @access      public
     * @param       int|string      $list_id            User id
     * @param       int|string      $friend_id          ID of the friend
     * @return      boolean
     */
    public function accept($list_id, $friend_id) {
        // Accept the share
        PDOFactory::sendQuery(
            $this->_db,
            'UPDATE todo_lists_share SET accepted = 1 WHERE list_id = :list_id AND user_id = :user_id',
            ["list_id" => (int) $list_id, "user_id" => (int) $friend_id],
            false
        );

        // Return result
        return (bool) PDOFactory::sendQuery(
            $this->_db,
            'SELECT share_id FROM todo_lists_share WHERE list_id = :list_id AND user_id = :user_id AND accepted = 0',
            ["list_id" => (int) $list_id, "user_id" => (int) $friend_id]
        );
    }

    /**
     * Delete a share.
     *
     * This function take the list id and the friend
     * id and delete the targeted share.
     *
     * @function    delete
     * @access      public
     * @param       int|string      $list_id            User id
     * @param       int|string      $friend_id          ID of the friend
     * @return      boolean
     */
    public function delete($list_id, $friend_id) {
        // Delete share
        PDOFactory::sendQuery(
            $this->_db,
            'DELETE FROM todo_lists_share WHERE list_id = :list_id AND user_id = :user_id',
            ["list_id" => (int) $list_id, "user_id" => (int) $friend_id],
            false
        );

        // Return result
        return (bool) PDOFactory::sendQuery(
            $this->_db,
            'SELECT share_id FROM todo_lists_share WHERE list_id = :list_id AND user_id = :user_id',
            ["list_id" => (int) $list_id, "user_id" => (int) $friend_id]
        );
    }
}