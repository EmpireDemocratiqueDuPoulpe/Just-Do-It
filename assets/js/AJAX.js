/**
 * An array that contains one object per query.
 * @typedef     {Array}     QueriesList
 */

/**
 * AJAX provide several methods to work with AJAX queries
 * simpler and with promises.
 *
 * Example:
 * const ajax = new AJAX();
 * ajax.call("./some/file/or/url", "POST", [name, id])
 *     .then(successCallback, errorCallback);
 *
 * @author  Alexis
 * @version 1.0
 * @access  public
 */
class AJAX {
    // Attributes
    queue;

    // Constructors
    constructor() {
        this.queue = [];
    }

    // Methods
    /**
     * Send a query with AJAX.
     *
     * This function send a query to a
     * given url and return a Promise.
     * Use this function followed by
     * .then to get result.
     *
     * Example:
     * const ajax = new AJAX();
     * ajax.call("./some/file/or/url", "POST", [name, id])
     *     .then(successCallback, errorCallback);
     *
     * @function    call
     * @access      public
     * @param       {string}    url     Url to file or resource
     * @param       {string}    type    (default = POST) Method type of the query (POST, GET, PUT, etc...)
     * @param       {Array}     data    (optional) Data array sent
     * @returns     {Promise<XMLHttpRequest>}
     */
    call(url, type, data) {
        // Init optional parameters
        type = type || "POST";
        data = data || [];

        const that = this;

        return new Promise(function (resolve, reject) {
            // XMLHttp object
            const xHttp = new XMLHttpRequest();
            xHttp.open(type, url, true);
            that.add(xHttp);
            xHttp.send(JSON.stringify(data));

            // Status event
            xHttp.onreadystatechange = function () {
                if (xHttp.readyState === XMLHttpRequest.DONE) {
                    if (xHttp.status === 200) {
                        //const JSONresp = JSON.parse(xHttp.responseText);
                        that.del(xHttp);
                        resolve(xHttp.responseText);

                    } else {
                        reject(xHttp.status)
                    }
                }
            }
        });
    }

    /**
     * Send multiples queries with AJAX.
     *
     * This function will send multiples
     * queries using a {QueriesList}. The
     * promise returned start the callback
     * when every promises contained are
     * finished.
     *
     * Example:
     * const ajax = new AJAX();
     * ajax.multipleCalls([
     *        {url: "/path/to/file/1", type: "POST", data: [1, 2, 3]},
     *        {url: "/path/to/file/2", type: "GET"},
     *        {url: "/path/to/file/3"}])
     *    .then(successCallback, errorCallback);
     *
     * @function    multipleCalls
     * @access      public
     * @param       {QueriesList}   queries     List of queries.
     * @return      {Promise<Array<Promise<XMLHttpRequest>>>}
     */
    multipleCalls(queries) {

        const that = this;
        let promises = [];

        // Start every promises
        queries.forEach(function (query) {
            let type = query.type || "POST";
            let data = query.data || [];

            promises.push(that.call(query.url, type, data));
        });

        return Promise.all(promises);
    }

    /**
     * Add a running XMLHttpRequest to
     * the queue.
     *
     * AJAX() has a queue with every
     * queries running. This function
     * add a newly created query to
     * this queue. This method shouldn't
     * be called outside of AJAX.call();
     *
     * @function    add
     * @access      public
     * @param       {XMLHttpRequest}    xHttp       Running XMLHttpRequest object
     * @return      {void}
     */
    add(xHttp) {
        this.queue.push(xHttp);
    }

    /**
     * Delete an ended XMLHttpRequest
     * of the queue.
     *
     * This method will remove an
     * ended XMLHttpRequest from the
     * queue. It shouldn't not be called
     * outside of AJAX.call();
     *
     * @function    del
     * @access      public
     * @param       {XMLHttpRequest}    xHttp       Ended XMLHttpRequest object
     * @return      {void}
     */
    del(xHttp) {
        const index = this.queue.indexOf(xHttp);
        if (index > -1) this.queue.splice(index, 1);
    }

    /**
     * Stop all running queries.
     *
     * It can be useful when you need
     * to stop every queries or when
     * some queries takes to much time.
     *
     * @function    abortAll
     * @access      public
     * @return      {void}
     */
    abortAll() {
        // Abort all AJAX queries
        this.queue.forEach(function (xHttp) {
            xHttp.abort();
        });

        // Clean the queue
        this.queue = [];
    }

    /**
     * Show a query error. It's can
     * be used by every ajax.call.then
     * to handle errors easily.
     *
     * @function    error
     * @access      public
     * @param       {string}    status      Error's status
     * @return      {void}
     */
    error(status) {
        alert(status);
    }
}