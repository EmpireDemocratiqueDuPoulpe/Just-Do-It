window.addEventListener("load", function () {
    addEventOnButton();
});

/**
 * Add event on "Add list" button.
 *
 * @function    addEventOnButton
 * @return      {void}
 */
function addEventOnButton() {

    // Get "add Todo list" div and init two vars which contain HTML of the div
    const addTodoList = document.querySelector("#addTodoList");
    let divContent1 = '';
    let divContent2 =
        '<form action="#" method="POST" class="noUpperMargin">' +
            '<div class="todoList grey">' +
                '<div class="tlHead field">' +
                    '<input type="text" id="tName" name="name" placeholder="Nouvelle Todo List" minlength="1" maxlength="32">' +
                '</div>' +
                '<div class="tlBody">' +
                    '<ul>' +
                    '<a href="" id="addList" class="seeMore" onclick="return addList()"><li><input type="checkbox" id="addListCheck"><label for="addListCheck"><i class="fas fa-plus-square"></i> Ajouter la liste</label></li></a>' +
                    '</ul>' +
                '</div>' +
            '</div>' +
        '</form>';

    addTodoList.addEventListener("click", function (e) {

        // Save content of div and replace it
        divContent1 = addTodoList.outerHTML;
        addTodoList.outerHTML = divContent2;

        addTodoList.classList.add("noHover");
    });
}

/**
 * Add a list.
 *
 * @function    addList
 * @async
 * @return      {boolean}
 */
function addList() {

    // Create AJAX instance and get todolist title
    const ajax = new AJAX();
    const todoListInput = document.querySelector("input[name=name]");
    const todoListTitle = todoListInput.value || todoListInput.placeholder || "Nouvelle liste";

    // Call the php script
    ajax.call("./php/addTodoList.php", "POST", [todoListTitle, "grey"])
        .then(reloadTodoLists, todoListErrors);

    // Prevent link from redirecting
    return false;
}

/**
 * Reload Todo lists
 *
 * @function    reloadTodoLists
 * @async
 * @return      {void}
 */
function reloadTodoLists() {

    // Get todo list
    const ajax = new AJAX();
    ajax.call("./php/getTodoList.php", "POST")
        .then(function (lists) {

            document.querySelector("#todoListContainer").innerHTML = String(lists);
            addEventOnButton();

        }, todoListErrors);
}

/**
 * Show an error if it's not possible
 * to add a list or to update them.
 *
 * @function    todoListErrors
 * @param       {string}        status      Error status
 * @return      {void}
 */
function todoListErrors(status) {
    alert(status);
}