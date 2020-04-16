// Elements
let addListDiv = null, shareListBts = null, delListBts = null;

// EVENTS
initListsEvents();

/**
 * Init every events
 *
 * @function    initListsEvents
 * @access      public
 * @return      {void}
 */
function initListsEvents () {
    addListDiv = document.querySelector("#addTodoList");
    shareListBts = document.querySelectorAll(".tlShareContainer");
    delListBts = document.querySelectorAll(".tlDeleteContainer");

    if (addListDiv) addListDiv.addEventListener("click", clickOnAdd);
    if (shareListBts) shareListBts.forEach(el => el.addEventListener("click", clickOnShare));
    if (delListBts) delListBts.forEach(el => el.addEventListener("click", clickOnDelete));
}

// GET
/**
 * Get lists
 *
 * @function    getLists
 * @access      public
 * @async
 * @return      {void}
 */
function getLists () {
    const ajax = new AJAX();

    ajax.call("./php/todoLists/get.php", "POST", [])
        .then((lists) => {
            document.querySelector("#todoListContainer").innerHTML = String(lists);
            initListsEvents();
        }, ajax.error);
}

// ADD
/**
 * Function executed when the "add list"
 * div is pressed. "this" refer to the
 * #addTodoList div.
 *
 * @function    clickOnAdd
 * @access      public
 * @param       {Event}     event   Click event
 * @return      {void}
 */
function clickOnAdd (event) {
    event.stopPropagation();
    this.outerHTML =
        '<div class="todoList pinkorange">' +
            '<form action="" method="POST" class="noUpperMargin">' +
                '<div class="tlHead field">' +
                '<input type="text" id="tName" name="name" placeholder="Nouvelle Todo List" minlength="1" maxlength="32">' +
            '</div>' +
            '<div class="tlBody">' +
                '<ul class="taskContainer">' +
                    '<a href="" id="addList" class="seeMore" onclick="return addList()">' +
                        '<li class="task">' +
                            '<input type="checkbox" id="addCheck">' +
                            '<label for="addCheck">' +
                                '<i class="fas fa-plus-square"></i> ' +
                                'Ajouter la liste' +
                            '</label>' +
                        '</li>' +
                    '</a>' +
                '</ul>' +
            '</div>' +
            '</form>'+
        '</div>';
}

/**
 * Function executed when the "add list"
 * button is pressed. "this" refer to the
 * #addTodoList div.
 *
 * @function    addList
 * @access      public
 * @async
 * @return      {boolean}   Always return false to prevent form redirecting
 */
function addList () {
    const ajax = new AJAX();

    // Get todo list title
    const todoListInput = document.querySelector(".todoList input[name=name]");
    const todoListTitle = todoListInput.value || todoListInput.placeholder || "Nouvelle liste";

    // Send the query
    ajax.call("./php/todoLists/add.php", "POST", [todoListTitle, "pinkorange"])
        .then(getLists, ajax.error);

    // Prevent link from redirecting
    return false;
}

// SHARE
/**
 * Function executed when the "share list"
 * button is pressed. "this" refer to the
 * .tlShareContainer of the targeted list.
 *
 * @function    clickOnShare
 * @access      public
 * @async
 * @param       {Event}     event   Click event
 * @return      {void}
 */
function clickOnShare (event) {
    event.stopPropagation();

    getShares(this.dataset.listId);
    showModal(true);
}

// DELETE
/**
 * Function executed when the "delete list"
 * button is pressed. "this" refer to the
 * .tlDeleteContainer of the targeted list.
 *
 * @function    clickOnDelete
 * @access      public
 * @async
 * @param       {Event}     event   Click event
 * @return      {void}
 */
function clickOnDelete (event) {
    event.stopPropagation();

    const ajax = new AJAX();
    ajax.call("./php/todoLists/delete.php", "POST", [this.dataset.listId])
        .then(getLists, ajax.error);
}