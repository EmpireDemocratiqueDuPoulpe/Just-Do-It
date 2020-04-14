initTasksEvents();

/**
 * Init every events
 *
 * @function    initTasksEvents
 * @access      public
 * @async
 * @return      {void}
 */
function initTasksEvents() {

    const addTask = document.querySelector(".addTask");
    const tasks = document.querySelectorAll(".task:not(.addTask)");
    const delTaskBts = document.querySelectorAll(".tDeleteContainer");
    const checkEveryTasksBt = document.querySelector("#checkAllTasks");
    const uncheckEveryTasksBt = document.querySelector("#uncheckAllTasks");

    ////// Add Event
    if (addTask) {
        addTask.removeEventListener("click", function () { });
        addTask.addEventListener("click", function (event) {
            event.stopPropagation();
            addTask.outerHTML =
                '<form action="" method="POST" class="noUpperMargin">' +
                    '<li class="task addTask noBottomMargin noHover">' +
                        '<input type="text" id="taName" name="name" placeholder="Nouvelle t&acirc;che" minlength="1" maxlength="32">' +
                        '<input type="submit" value="AJOUTER"  onclick="return addTask()">' +
                    '</li>' +
                '</form>';
        });
    }

    ////// Update Event
    if (tasks) {
        tasks.forEach(function (task) {
            task.addEventListener("click", function (event) {
                event.stopPropagation();
                updateTask(this.dataset.taskId, this.dataset.taskStatus, false);
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

    ////// Check every tasks Event
    if (checkEveryTasksBt) {
        checkEveryTasksBt.addEventListener("click", function (event) {
            checkEveryTasks();
        });
    }

    ////// Uncheck every tasks Event
    if (uncheckEveryTasksBt) {
        uncheckEveryTasksBt.addEventListener("click", function (event) {
            uncheckEveryTasks();
        });
    }
}

/**
 * Get tasks
 *
 * @function    getTasks
 * @access      public
 * @async
 * @return      {void}
 */
function getTasks() {
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
            initTasksEvents();
        }, ajax.error);
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
    const ajax = new AJAX();

    // Get list id and task name
    const listInput = document.querySelector("#tId");
    const listId = listInput.value;

    const taskInput = document.querySelector("#taName");
    const taskName = taskInput.value || taskInput.placeholder || "Nouvelle t&acirc;che";

    // Send the query
    ajax.call("./php/tasks/add.php", "POST", [listId, taskName, 0])
        .then(getTasks, ajax.error);

    // Prevent link from redirecting
    return false;
}

/**
 * Update a task.
 *
 * @function    updateTask
 * @access      public
 * @async
 * @param       {string|Number}     taskId              Targeted task id
 * @param       {string|Number}     status              Task's new status
 * @param       {boolean}           noDisplayUpdate     Update display after update?
 * @return      {void}
 */
function updateTask(taskId, status, noDisplayUpdate) {
    const ajax = new AJAX();

    ajax.call("./php/tasks/update.php", "POST", [taskId, status])
        .then(function () {
            const page = window.location.pathname.split("/").pop();

            if (page && page !== "index.php")
                if (!noDisplayUpdate) getTasks();
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
        .then(getTasks, ajax.error);
}

/**
 * Check every tasks in "On going".
 *
 * @function    checkEveryTasks
 * @access      public
 * @return      {void}
 */
function checkEveryTasks() {
    const tasks = document.querySelectorAll("#tVOngoing .task:not(.addTask)");

    if (tasks) {
        tasks.forEach(function (task) {
            task.click();
        });
    }
}

/**
 * Uncheck every tasks in "Finished".
 *
 * @function    uncheckEveryTasks
 * @access      public
 * @return      {void}
 */
function uncheckEveryTasks() {
    const tasks = document.querySelectorAll("#tVFinished .task:not(.addTask)");

    if (tasks) {
        tasks.forEach(function (task) {
            task.click();
        });
    }
}