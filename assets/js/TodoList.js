window.addEventListener("load", function () {
    addAddEvent();
    addDeleteEvent();
});

/**
 * Add event on "Add list" button.
 *
 * @function    addAddEvent
 * @access      public
 * @return      {void}
 */
function addAddEvent() {

    // Get "add Todo list" div and init two vars which contain HTML of the div
    const addTodoList = document.querySelector("#addTodoList");
    let addTodoListHTML =
        '<form action="" method="POST" class="noUpperMargin">' +
            '<div class="todoList pinkorange">' +
                '<div class="tlHead field">' +
                    '<input type="text" id="tName" name="name" placeholder="Nouvelle Todo List" minlength="1" maxlength="32">' +
                '</div>' +
                '<div class="tlBody">' +
                    '<ul class="taskContainer">' +
                        '<a href="" id="addList" class="seeMore" onclick="return addList()"><li class="task"><input type="checkbox" id="addListCheck"><label for="addListCheck"><i class="fas fa-plus-square"></i> Ajouter la liste</label></li></a>' +
                    '</ul>' +
                '</div>' +
            '</div>' +
        '</form>';

    addTodoList.addEventListener("click", function (e) {

        // Save content of div and replace it
        addTodoList.outerHTML = addTodoListHTML;
        addTodoList.classList.add("noHover");
    });
}

/**
 * Add event on "Delete list" button.
 *
 * @function    addDeleteEvent
 * @access      public
 * @return      {void}
 */
function addDeleteEvent() {

    document.querySelectorAll(".tlDeleteContainer").forEach(function (el) {

        el.addEventListener("click", function () {

            const ajax = new AJAX();
            ajax.call("./php/deleteTodoList.php", "POST", [this.dataset.listId])
                .then(reloadTodoLists, todoListErrors);
        });
    });
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

    // Create AJAX instance and get todolist title
    const ajax = new AJAX();
    const todoListInput = document.querySelector("input[name=name]");
    const todoListTitle = todoListInput.value || todoListInput.placeholder || "Nouvelle liste";

    // Call the php script
    ajax.call("./php/addTodoList.php", "POST", [todoListTitle, "pinkorange"])
        .then(reloadTodoLists, todoListErrors);

    // Prevent link from redirecting
    return false;
}

/**
 * Reload Todo lists
 *
 * @function    reloadTodoLists
 * @access      public
 * @async
 * @return      {void}
 */
function reloadTodoLists() {

    // Get todo list
    const ajax = new AJAX();
    ajax.call("./php/getTodoList.php", "POST")
        .then(function (lists) {

            document.querySelector("#todoListContainer").innerHTML = String(lists);
            addAddEvent();
            addDeleteEvent();

        }, todoListErrors);
}

/**
 * Show an error if it's not possible
 * to add a list, to update them or to
 * delete one.
 *
 * @function    todoListErrors
 * @access      public
 * @param       {string}        status      Error status
 * @return      {void}
 */
function todoListErrors(status) {
    alert(status);
}