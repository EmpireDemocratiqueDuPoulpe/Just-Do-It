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
}