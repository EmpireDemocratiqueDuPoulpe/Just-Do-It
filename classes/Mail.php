<?php

/**
 * Mail provide a functions to send mails.
 *
 * Mail can have multiple methods used to send preformed mails
 * like a share confirmation.
 *
 * Example:
 * Mail::sendShareConfirmation("Farm&Furious", "eatmyseeds@farm.de");
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
abstract class Mail {
    /**
     * Send a share confirmation email.
     *
     * Send a share confirmation email in plain text and
     * in HTML.
     *
     * @function    sendShareConfirmation
     * @access      public
     * @param       string          $listOwner  Username of the user who own the list
     * @param       string          $to         Email of the user who will receive the mail
     * @param       int|string      $list_id    ID of the shared list
     * @param       int|string      $user_id    ID of the targeted user
     * @return      void
     */
    public static function sendShareConfirmation($listOwner, $to,  $list_id, $user_id) {
        // Init the new line var and the boundary
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $to)) {
            $n = "\r\n";
        } else {
            $n = "\n";
        }

        $boundary = "-----=" . md5(rand());

        // Init the link
        $path = explode("/", str_replace("\\", "/", __DIR__));
        end($path);
        $dirname = "/" . prev($path);

        $linkToAccept = "http://" . $_SERVER['SERVER_NAME'] . $dirname . "/php/shares/accept.php?list_id=$list_id&user_id=$user_id";

        //Subject
        $subject = "$listOwner vous a ajouté à une liste.";

        // Header
        $headers = "From: \"Le Monke\"<alexislecomte777@yahoo.fr>" . "\r\n" .
                    "Reply-to: \"Le Monke\"<alexislecomte777@yahoo.fr>" . "\r\n" .
                    "MIME-Version: 1.0" . "\r\n" .
                    "Content-Type: multipart/alternative;" . "\r\n" . " boundary=\"$boundary\"" . "\r\n";

        // Message
        $message = "\r\n" . "--" . $boundary . "\r\n" .
                    "Content-Type: text/plain; charset=\"UTF-8\"" . "\r\n" .
                    "Content-Transfer-Encoding: 8bit" . "\r\n" . "\r\n" .

                    "Le mirifique $listOwner a décidé de vous ajouter à une liste de choses à faire." . $n .
                    "S'offre à vous deux choix. Accepter en cliquant sur le lien juste dessus (oui le truc " .
                    "bizarre qui commence par http) ou refuser en ne faisant rien. Attention, nous ne sommes pas " .
                    "tenus responsables des conséquences si vous ne cliquez pas sur le lien." . $n . $n .
                    $linkToAccept . $n . $n .
                    "(Mail non surtaxé et non disponible chez tous vos marchands de journaux parce que c'est un mail " .
                    "en fait et ... bah ça marche pas quoi.)" .
                    $n;

        $message = "\r\n" . "--" . $boundary . "\r\n" .
                    "Content-Type: text/html; charset=\"UTF-8\"" . "\r\n" .
                    "Content-Transfer-Encoding: 8bit" . "\r\n" . "\r\n" .
                    "<html lang=\"fr\">
                        <head>
                            <title>$listOwner vous a ajouté à une liste.</title>
                            <meta charset=\"utf-8\"/>
                            <style>
                                header      { background: #DA22FF; color: #FFFFFF; }
                                em          { font-size: 0.9em; font-style: italic;}
                                span        { text-decoration: line-through; }
                                
                                a {
                                    display: block;
                                    background: #A94CE6;
                                    color: #FFFFFF;
                                    border: none;
                                    border-radius: 5px;
                                    transition: background-color 250ms;
                                }
                                
                                a:hover     { background-color: #9a4cd7; }
                                a:active    { background-color: #884ac3; padding: 0; transition-duration: 0s; }
                                a:focus     { outline: none; }
                            </style>
                        </head>
                        
                        <body>
                            <header style='background: #DA22FF; color: #FFFFFF;'>
                                <h1>Le mirifique $listOwner a décidé de vous ajouter à une liste de choses à faire.</h1>
                            </header>
                            
                            <div>
                                <p>
                                    S'offre à vous deux choix. Accepter en cliquant sur le lien juste dessus <em>(oui le truc 
                                    bizarre en violet)</em> ou refuser en ne faisant rien. Attention, nous ne sommes pas 
                                    tenus responsables des conséquences si vous ne cliquez pas sur le lien. <br> <br>
                                    
                                    <a href=\"$linkToAccept\">J'accepte de rejoindre <span><em>la table ronde</em></span> la liste</a> <br> <br>
                                    
                                    <em>(Mail non surtaxé et non disponible chez tous vos marchands de journaux parce que c'est un mail 
                                    en fait et ... bah ça marche pas quoi.)</em>
                                </p>
                            </div>
                        </body>
                    </html>" . $n;

        $message .= $n . "--" . $boundary . "--" . $n;

        // Send
        mail($to, $subject, $message, $headers);
    }
}