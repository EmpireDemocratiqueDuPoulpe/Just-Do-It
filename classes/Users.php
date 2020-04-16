<?php

/**
 * Users provide several methods to work with users
 * registered on the site.
 *
 * Tasks provide methods to get a user's email, etc...
 *
 * Example:
 * $UsersManager = new Users();
 * $email = $UsersManager->getEmail($user_id);
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
class Users {
    /** Attributes
     * @var     PDO     PDO Object connected to the database
     */
    private $_db;

    /**
     * Users constructor.
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
     * Get a user email.
     *
     * This function get the email address
     * of a user using his id.
     *
     * @function    getEmail
     * @access      public
     * @param       int|string      $user_id    User id
     * @return      string          Email or an error.
     */
    public function getEmail($user_id) {
        return PDOFactory::sendQuery(
            $this->_db,
            'SELECT email FROM users WHERE user_id = :user_id',
            ["user_id" => (int) $user_id]
        )[0]["email"];
    }
}