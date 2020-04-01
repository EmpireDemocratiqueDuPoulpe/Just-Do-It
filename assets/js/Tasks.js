window.addEventListener("load", function () {
    addAddEvent();
    addDeleteEvent();
});

/**
 * Add event on "Add task" button.
 *
 * @function    addAddEvent
 * @access      public
 * @return      {void}
 */
function addAddEvent() {

    // Get "add task" div and init two vars which contain HTML of the div
    const addTask = document.querySelector(".addTask");
    let addTaskHTML =
        '<form action="" method="POST" class="noUpperMargin">' +
            '<li class="task addTask noBottomMargin">' +
                '<input type="text" id="taName" name="name" placeholder="Nouvelle t&acirc;che" minlength="1" maxlength="32">' +
                '<input type="submit" value="AJOUTER"  onclick="return addTask()">' +
            '</li>' +
        '</form>';

    addTask.addEventListener("click", function (e) {

        // Save content of div and replace it
        addTask.outerHTML = addTaskHTML;
        addTask.classList.add("noHover");
    });
}

/**
 * Add delete event on "Delete task" button.
 *
 * @function    addDeleteEvent
 * @access      public
 * @return      {void}
 */
function addDeleteEvent() {

    document.querySelectorAll(".tDeleteContainer").forEach(function (el) {

        el.addEventListener("click", function () {

            const ajax = new AJAX();
            ajax.call("./php/deleteTask.php", "POST", [this.dataset.taskId])
                .then(reloadTasks, taskErrors);
        });
    });
}

/**
 * Add a task.
 *
 * @function    addTask
 * @access      public
 * @async
 * @return      {boolean}
 */
function addTask() {
    // Create AJAX instance and get task name
    const ajax = new AJAX();

    const listInput = document.querySelector("#tId");
    const listId = listInput.value;

    const taskInput = document.querySelector("#taName");
    const taskName = taskInput.value || taskInput.placeholder || "Nouvelle t&acirc;che";

    // Call the php script
    ajax.call("./php/addTask.php", "POST", [listId, taskName, 0])
        .then(reloadTasks, taskErrors);

    // Prevent link from redirecting
    return false;
}

/**
 * Reload tasks
 *
 * @function    reloadTasks
 * @access      public
 * @async
 * @return      {void}
 */
function reloadTasks() {
    // Get tasks
    const ajax = new AJAX();
    const listInput = document.querySelector("#tId");
    const listId = listInput.value;

    ajax.multipleCalls([
            {url: "./php/getOngoingTasks.php", type: "POST", data: [listId]},
            {url: "./php/getFinishedTasks.php", type: "POST", data: [listId]}])
        .then(function (tasks) {
            document.querySelector("#tVOngoing .taskContainer").innerHTML = String(tasks[0]);
            document.querySelector("#tVFinished .taskContainer").innerHTML = String(tasks[1]);
            addAddEvent();
            addDeleteEvent();
        }, taskErrors);
}

/**
 * Show an error if it's not possible
 * to add a task, to update them or to
 * delete one.
 *
 * @function    taskErrors
 * @access      public
 * @param       {string}        status      Error status
 * @return      {void}
 */
function taskErrors(status) {
    alert(status);
}