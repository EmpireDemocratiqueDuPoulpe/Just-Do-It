window.addEventListener("load", initListsEvents);

/**
 * Init every events
 *
 * @function    initListsEvents
 * @access      public
 * @async
 * @return      {void}
 */
function initListsEvents() {

    const addListDiv = document.querySelector("#addTodoList");
    const delListBts = document.querySelectorAll(".tlDeleteContainer");

    ////// Add Event
    if (addListDiv) {
        addListDiv.addEventListener("click", function (event) {
            event.stopPropagation();
            addListDiv.outerHTML =
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
                                            '<i class="fas fa-plus-square"></i>' +
                                            'Ajouter la liste' +
                                        '</label>' +
                                    '</li>' +
                                '</a>' +
                            '</ul>' +
                        '</div>' +
                    '</form>'+
                '</div>';
        });
    }

    ////// Delete Event
    if (delListBts) {
        delListBts.forEach(function (delListBt) {
            delListBt.addEventListener("click", function (event) {
                event.stopPropagation();
                delList(this.dataset.listId);
            });
        });
    }
}

/**
 * Get Todo lists
 *
 * @function    getList
 * @access      public
 * @async
 * @return      {void}
 */
function getList() {
    const ajax = new AJAX();
    ajax.call("./php/todoLists/get.php", "POST", [])
        .then(function (lists) {
            document.querySelector("#todoListContainer").innerHTML = String(lists);
            initListsEvents();
        }, ajax.error);
}

/**
 * Add a list.
 *
 * @function    addList
 * @access      public
 * @async
 * @return      {boolean}
 */
function addList() {
    const ajax = new AJAX();

    // Get todo list title
    const todoListInput = document.querySelector("input[name=name]");
    const todoListTitle = todoListInput.value || todoListInput.placeholder || "Nouvelle liste";

    // Send the query
    ajax.call("./php/todoLists/add.php", "POST", [todoListTitle, "pinkorange"])
        .then(getList, ajax.error);

    // Prevent link from redirecting
    return false;
}

/**
 * Add event on "Delete list" button.
 *
 * @function    delList
 * @access      public
 * @async
 * @param       {string|Number}     listId      Targeted list id
 * @return      {void}
 */
function delList(listId) {
    const ajax = new AJAX();
    ajax.call("./php/todoLists/delete.php", "POST", [listId])
        .then(getList, ajax.error);
}