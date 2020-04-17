// Elements
let sLMClose = null, shareFriends = null, unshareFriends = null;

// EVENTS
initShareEvents();

/**
 * Init every events
 *
 * @function    initShareEvents
 * @access      public
 * @return      {void}
 */
function initShareEvents () {
    sLMClose = document.querySelector("#sLMClose");
    shareFriends = document.querySelectorAll("#sLMFriendsBody .shareFriend");
    unshareFriends = document.querySelectorAll("#sLMSharedUsersBody .shareFriend");

    if (sLMClose) sLMClose.addEventListener("click", clickOnSLMClose);
    if (shareFriends) shareFriends.forEach(el => el.addEventListener("click", clickOnShareFriend));
    if (unshareFriends) unshareFriends.forEach(el => el.addEventListener("click", clickOnUnshareFriend));
}

// OPEN/CLOSE MODAL
/**
 * Function executed when the "close share
 * modal" button is pressed. "this" refer to
 * #sLMClose.
 *
 * @function    clickOnSLMClose
 * @access      public
 * @param       {Event}     event   Click event
 * @return      {void}
 */
function clickOnSLMClose (event) {
    event.stopPropagation();
    showModal(false);
}

/**
 * Show or hide the modal.
 *
 * @function    showModal
 * @access      public
 * @param       {boolean}   show    Show the modal (true) or hide it (false)
 * @return      {void}
 */
function showModal (show) {
    const modal = document.querySelector("#shareListModalBg");

    if (show) {
        document.body.classList.add("modalOpened");
        if (modal) modal.style.display = "block";
    } else {
        document.body.classList.remove("modalOpened");
        if (modal) modal.style.display = "none";
    }
}

// GET
/**
 * Get shares
 *
 * @function    getShares
 * @access      public
 * @async
 * @return      {void}
 */
function getShares (listId) {
    const ajax = new AJAX();
    ajax.multipleCalls(
        [{url: "./php/shares/get.php", type: "POST", data: [listId]},
            {url: "./php/friends/getNotShared.php", type: "POST", data: [listId]}])
        .then((users_list) => {
            const shareListModal = document.querySelector("#shareListModal");
            const sLMSharedUsersBody = document.querySelector("#sLMSharedUsersBody ul");
            const sLMFriendsBody = document.querySelector("#sLMFriendsBody ul");

            if (shareListModal) shareListModal.dataset.listId = listId;
            if (sLMSharedUsersBody) sLMSharedUsersBody.innerHTML = String(users_list[0]);
            if (sLMFriendsBody) sLMFriendsBody.innerHTML = String(users_list[1]);

            initShareEvents();
        }, ajax.error);
}

// SHARE
function clickOnShareFriend (event) {
    event.stopPropagation();

    shareFriends = document.querySelectorAll("#sLMFriendsBody .shareFriend");
    unshareFriends = document.querySelectorAll("#sLMSharedUsersBody .shareFriend");

    if (shareFriends) shareFriends.forEach(el => el.removeEventListener("click", clickOnShareFriend));
    if (unshareFriends) unshareFriends.forEach(el => el.removeEventListener("click", clickOnUnshareFriend));

    const params = [this.dataset.listId, this.dataset.friendId];

    const ajax = new AJAX();
    ajax.call("./php/shares/add.php", "POST", params)
        .then(() => {
            const shareListModal = document.querySelector("#shareListModal");
            const listId = shareListModal.dataset.listId;

            getShares(listId);

            ajax.call("./php/sendMails/share_confirmation.php", "POST", params)
                .then(() => {}, ajax.error);

        }, ajax.error);
}

// UNSHARE
function clickOnUnshareFriend (event) {
    event.stopPropagation();

    const ajax = new AJAX();
    ajax.call("./php/shares/delete.php", "POST", [this.dataset.listId, this.dataset.friendId])
        .then(() => {
            const shareListModal = document.querySelector("#shareListModal");
            const listId = shareListModal.dataset.listId;

            getShares(listId);
        }, ajax.error);
}