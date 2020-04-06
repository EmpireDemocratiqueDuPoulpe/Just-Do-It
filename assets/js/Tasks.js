window.addEventListener("load", initEvents);

/**
 * Init every events
 */
function initEvents() {

    const addTask = document.querySelector(".addTask");
    const tasks = document.querySelectorAll(".task:not(.addTask)");
    const delTaskBts = document.querySelectorAll(".tDeleteContainer");

    ////// Add Event
    if (addTask) {
        addTask.addEventListener("click", function (event) {
            event.stopPropagation();
            addTask.outerHTML =
                '<form action="" method="POST" class="noUpperMargin">' +
                    '<li class="task addTask noBottomMargin noHover">' +
                        '<input type="text" id="taName" name="name" placeholder="Nouvelle t&acirc;che" minlength="1" maxlength="32">' +
                        '<input type="submit" value="AJOUTER"  onclick="return add()">' +
                    '</li>' +
                '</form>';
        });
    }

    ////// Update Event
    if (tasks) {
        tasks.forEach(function (task) {
            task.addEventListener("click", function (event) {
                event.stopPropagation();
                update(this.dataset.taskId, this.dataset.taskStatus);
            });
        });
    }

    ////// Delete Event
    if (delTaskBts) {
        delTaskBts.forEach(function (delTaskBt) {
            delTaskBt.addEventListener("click", function (event) {
                event.stopPropagation();
                del(this.parentNode.dataset.taskId);
            });
        });
    }
}

/**
 * Get tasks
 *
 * @function    get
 * @access      public
 * @async
 * @return      {void}
 */
function get() {
    // Get list id
    const ajax = new AJAX();
    const listInput = document.querySelector("#tId");
    const listId = listInput.value;

    // Get tasks
    ajax.multipleCalls([
        {url: "./php/tasks/getOngoing.php", type: "POST", data: [listId]},
        {url: "./php/tasks/getFinished.php", type: "POST", data: [listId]}])
        .then(function (tasks) {
            document.querySelector("#tVOngoing .taskContainer").innerHTML = String(tasks[0]);
            document.querySelector("#tVFinished .taskContainer").innerHTML = String(tasks[1]);
            initEvents();
        }, ajax.error);
}

/**
 * Add a task.
 *
 * @function    add
 * @access      public
 * @async
 * @return      {boolean}
 */
function add() {
    const ajax = new AJAX();

    // Get list id and task name
    const listInput = document.querySelector("#tId");
    const listId = listInput.value;

    const taskInput = document.querySelector("#taName");
    const taskName = taskInput.value || taskInput.placeholder || "Nouvelle t&acirc;che";

    // Send the query
    ajax.call("./php/tasks/add.php", "POST", [listId, taskName, 0])
        .then(get, ajax.error);

    // Prevent link from redirecting
    return false;
}

/**
 * Update a task.
 *
 * @function    update
 * @access      public
 * @async
 * @param       {string|Number}     taskId      Targeted task id
 * @param       {string|Number}     status      Task's new status
 * @return      {void}
 */
function update(taskId, status) {
    const ajax = new AJAX();

    ajax.call("./php/tasks/update.php", "POST", [taskId, status])
        .then(function () {
            const page = window.location.pathname.split("/").pop();

            if (page && page !== "index.php") get();
        }, ajax.error);
}

/**
 * Delete a task.
 *
 * @function    del
 * @access      public
 * @async
 * @param       {string|Number}     taskId      Targeted task id
 * @return      {boolean}
 */
function del(taskId) {
    const ajax = new AJAX();
    ajax.call("./php/tasks/delete.php", "POST", [taskId])
        .then(get, ajax.error);
}