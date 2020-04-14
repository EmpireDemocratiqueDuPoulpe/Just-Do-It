initFriendsEvents();

/**
 * Init every events
 *
 * @function    initFriendsEvents
 * @access      public
 * @async
 * @return      {void}
 */
function initFriendsEvents() {
    const addFriend = document.querySelector(".addFriend");
    const delFriendBts = document.querySelectorAll(".fDeleteContainer");

    ////// Add Event
    if (addFriend) {
        addFriend.addEventListener("click", function (event) {
            event.stopPropagation();
            addFriend.outerHTML =
                '<li class="friend addFriend noBottomMargin noHover">' +
                    '<form action="" method="POST" class="noUpperMargin">' +
                        '<input type="text" id="fUser" name="user" placeholder="Nom d\'utilisateur/e-mail" minlength="1" maxlength="255">' +
                        '<input type="submit" value="AJOUTER"  onclick="return addFriend()">' +
                    '</form>' +
                '</li>';
        });
    }

    ////// Delete Event
    if (delFriendBts) {
        delFriendBts.forEach(function (delFriendBt) {
            delFriendBt.addEventListener("click", function (event) {
                event.stopPropagation();
                delFriend(this.dataset.friendId);
            });
        });
    }
}

/**
 * Get friends
 *
 * @function    getFriends
 * @access      public
 * @async
 * @return      {void}
 */
function getFriends() {
    const ajax = new AJAX();

    // Get friends
    ajax.call("./php/friends/get.php", "POST", [])
        .then(function (friends) {
            document.querySelector("#friendListBody ul").innerHTML = String(friends);
            initFriendsEvents();
        }, ajax.error);
}

/**
 * Add a friend.
 *
 * @function    addFriend
 * @access      public
 * @async
 * @return      {boolean}
 */
function addFriend() {
    const ajax = new AJAX();

    // Get user name or e-mail
    const friendInput = document.querySelector("#fUser");
    const friend = friendInput.value || "";

    // Send the query
    ajax.call("./php/friends/add.php", "POST", [friend])
        .then(getFriends, ajax.error);

    // Prevent link from redirecting
    return false;
}

/**
 * Delete a friend.
 *
 * @function    delFriend
 * @access      public
 * @async
 * @return      {boolean}
 */
function delFriend(friendId) {
    const ajax = new AJAX();
    ajax.call("./php/friends/delete.php", "POST", [friendId])
        .then(getFriends, ajax.error);
}