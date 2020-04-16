<?php

/**
 * Friends provide several methods to work with friends
 * of user.
 *
 * Example:
 * $FriendsManager = new Friends($db);
 * $friends = $FriendsManager->get($_SESSION["id"]);
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
class Friends {
    /** Attributes
     * @var     PDO     PDO Object connected to the database
     */
    private $_db;

    /**
     * Friends constructor.
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
     * Get friends of user.
     *
     * This function get every friends of a user. It
     * use the user id and return an array.
     *
     * @function    getAll
     * @access      public
     * @param       int|string      $user_id    User id
     * @return      array|string    Array of friends or an error.
     */
    public function getAll($user_id) {
        return PDOFactory::sendQuery(
            $this->_db,
        'SELECT
                us.user_id,
                us.username
            FROM
                users us
            WHERE
                us.user_id IN (
                    (SELECT user_a_id FROM friendships WHERE user_b_id = :user_id)
                        UNION
                    (SELECT user_b_id FROM friendships WHERE user_a_id = :user_id)
                )',
            ["user_id" => (int) $user_id]
        );
    }

    /**
     * Get friends who hasn't been added to a list.
     *
     * This function get every friends who hasn't
     * been added to a list. It use the list id and
     * return an array of users.
     *
     * @function    getAllNotShared
     * @access      public
     * @param       int|string      $user_id    User id
     * @param       int|string      $list_id    List id
     * @return      array|string    Array of friends or an error.
     */
    public function getAllNotShared($user_id, $list_id) {
        return PDOFactory::sendQuery(
            $this->_db,
            'SELECT
                    us.user_id,
                    us.username
                FROM
                    users us
                WHERE
                    NOT us.user_id = :user_id AND us.user_id NOT IN (
                        SELECT tls.user_id FROM todo_lists_share tls WHERE tls.list_id = :list_id
                    )',
            ["user_id" => (int) $user_id, "list_id" => (int) $list_id]
        );
    }

    /**
     * Add a friend.
     *
     * This function take the user id and the new friend's
     * id and create a new friendship.
     *
     * @function    addById
     * @access      public
     * @param       int|string      $user_id            User id
     * @param       string          $new_friend_id      ID of the new friend
     * @return      boolean
     */
    public function addById($user_id, $new_friend_id) {

        // Get last ID before query
        $lastIDBefore = PDOFactory::sendQuery($this->_db, 'SELECT friendship_id FROM friendships ORDER BY friendship_id DESC LIMIT 1')[0]["friendship_id"];

        // Create the friendships
        PDOFactory::sendQuery(
            $this->_db,
            'INSERT INTO friendships(user_a_id, user_b_id) VALUES (:user_a_id, :user_b_id)',
            ["user_a_id" => (int) $user_id, "user_b_id" => (int) $new_friend_id],
            false
        );

        // Get last ID after query
        $lastIDAfter = PDOFactory::sendQuery($this->_db, 'SELECT friendship_id FROM friendships ORDER BY friendship_id DESC LIMIT 1')[0]["friendship_id"];

        // Return result
        return $lastIDBefore !== $lastIDAfter;
    }

    /**
     * Add a friend.
     *
     * This function take the user id and the new friend's
     * name and create a new friendship.
     *
     * @function    addByUsername
     * @access      public
     * @param       int|string      $user_id            User id
     * @param       int|string      $new_friend_name    Username of the new friend
     * @return      boolean
     */
    public function addByUsername($user_id, $new_friend_name) {

        // Check if friend exist
        $friend_id = PDOFactory::sendQuery(
            $this->_db,
            'SELECT user_id from users WHERE username = :username AND NOT user_id = :user_id',
            ["username" => $new_friend_name, "user_id" => $user_id]
        );

        if (!$friend_id) return false;
        $friend_id = $friend_id[0]["user_id"];

        // Return result
        return $this->addById($user_id, $friend_id);
    }

    /**
     * Add a friend.
     *
     * This function take the user id and the new friend's
     * e-mail and create a new friendship.
     *
     * @function    addByEmail
     * @access      public
     * @param       int|string      $user_id            User id
     * @param       string          $new_friend_email   Email of the new friend
     * @return      boolean
     */
    public function addByEmail($user_id, $new_friend_email) {

        // Check if friend exist
        $friend_id = PDOFactory::sendQuery(
            $this->_db,
            'SELECT user_id from users WHERE email = :email AND NOT user_id = :user_id',
            ["email" => $new_friend_email, "user_id" => $user_id]
        );

        if (!$friend_id) return false;
        $friend_id = $friend_id[0]["user_id"];

        // Return result
        return $this->addById($user_id, $friend_id);
    }

    /**
     * Delete a friend.
     *
     * This function take the friend id and the
     * user id and delete the friendship from
     * the database.
     *
     * @function    delete
     * @access      public
     * @param       int|string      $user_id    User id
     * @param       int|string      $friend_id  Id of the targeted friend
     * @return      boolean
     */
    public function delete($user_id, $friend_id) {
        // Delete friend
        PDOFactory::sendQuery(
            $this->_db,
            'DELETE FROM friendships WHERE (user_a_id = :user_a_id1 AND user_b_id = :user_b_id1) OR (user_a_id = :user_a_id2 AND user_b_id = :user_b_id2)',
            ["user_a_id1" => (int) $user_id, "user_b_id1" => (int) $friend_id, "user_a_id2" => (int) $friend_id, "user_b_id2" => (int) $user_id],
            false
        );

        // Return result
        return (bool) PDOFactory::sendQuery(
            $this->_db,
            'SELECT friendship_id FROM friendships WHERE (user_a_id = :user_a_id1 AND user_b_id = :user_b_id1) OR (user_a_id = :user_a_id2 AND user_b_id = :user_b_id2)',
            ["user_a_id1" => (int) $user_id, "user_b_id1" => (int) $friend_id, "user_a_id2" => (int) $friend_id, "user_b_id2" => (int) $user_id]);
    }
}