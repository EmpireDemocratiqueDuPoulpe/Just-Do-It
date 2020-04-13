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

        // Get friendships
        $friendships =  PDOFactory::sendQuery(
            $this->_db,
            'SELECT user_a_id, user_b_id FROM friendships WHERE user_a_id = :user_id OR user_b_id = :user_id',
            ["user_id" => (int) $user_id]
        );

        // Format a var used with SQL IN and an array
        // Example:
        // $friends_id --> ":id8, :id4, :id16"
        // $friends_id_params --> ["id8" => 8, "id4" => 4, "id16" => 16]
        $friends_id = "";
        $friends_id_params = [];

        foreach ($friendships as $friendship) {
            if ($friendship["user_a_id"] != $user_id)   { $id = $friendship["user_a_id"]; }
            else                                        { $id = $friendship["user_b_id"]; }

            $key = "id$id";
            $friends_id .= ":$key, ";
            $friends_id_params[$key] = $id;
        }
        $friends_id = rtrim($friends_id,", ");

        // Return the friends list
        return PDOFactory::sendQuery(
            $this->_db,
            "SELECT user_id, username FROM users WHERE user_id IN($friends_id)",
            $friends_id_params
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
     * @param       string          $new_friend_name    Username of the new friend
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
}