/**
 * @api {post} /new/event New Event
 * @apiVersion 1.0.0
 * @apiName New Event
 * @apiGroup Events
 *
 * @apiParam {String} api_token user.api_token
 * @apiParam {Date} start 2017-12-11 12:00:00
 * @apiParam {Date} end 2017-12-11 12:00:00
 * @apiParam {Integer} user_id id of user for who the event is
 *
 * @apiSuccess {Boolean} hasErrors  true or false
 * @apiSuccess {Object} errors  Object with errors, if there are any
 * @apiSuccess {Object} event   Created event info
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "hasErrors": false,
 *       "errors": [],
 *       "event": {
 *           "start": event.start,
 *           "end": event.end,
 *           "branch_id": event.branch_id,
 *           "user_id": event.user_id,
 *           "active": false
 *       }
 *     }
 *
 * @apiError Unauthorized No access or input validation errors
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 403 Not Found
 *     {
 *       "hasErrors": true,
 *       "errors": [errors]
 *     }
 */

 /**
  * @api {get} /events-branch/copy-last-week/{start}/{end} Copy Events from last week
  * @apiVersion 1.0.0
  * @apiName Copy from last week
  * @apiGroup Events
  *
  * @apiParam {String} api_token user.api_token
  * @apiParam {Timestamp} start unix time
  * @apiParam {Timestamp} end unix time
  *
  * @apiSuccess {Boolean} hasErrors  true or false
  * @apiSuccess {Object} errors  Object with errors, if there are any
  * @apiSuccess {Object} duplicatedEvents  Array with events.
  *
  * @apiSuccessExample Success-Response:
  *     HTTP/1.1 200 OK
  *     {
  *       "hasErrors": false,
  *       "errors": [],
  *       "duplicatedEvents": [
  *         {
  *           "user_id": users.name,
  *           "branch_id": branches.id,
  *           "start": events.start,
  *           "end": events.end,
  *           "event_id": events.id,
  *           "active": 0
  *         }
  *       ]
  *     }
  *
  * @apiError Unauthorized No access or input validation errors
  *
  * @apiErrorExample Error-Response:
  *     HTTP/1.1 403 Not Found
  *     {
  *       "hasErrors": true,
  *       "errors": [errors]
  *     }
  */

 /**
  * @api {get} /events-branch/timestamp/{start}/{end} Events for current branch
  * @apiVersion 1.0.0
  * @apiName Events for current branch
  * @apiGroup Events
  *
  * @apiParam {String} api_token user.api_token
  * @apiParam {Timestamp} start unix time
  * @apiParam {Timestamp} end unix time
  *
  * @apiSuccess {Boolean} hasErrors  true or false
  * @apiSuccess {Object} errors  Object with errors, if there are any
  * @apiSuccess {Object} unPlannedUsers  Array with unplanned users.
  * @apiSuccess {Object} events  Array with events.
  *
  * @apiSuccessExample Success-Response:
  *     HTTP/1.1 200 OK
  *     {
  *       "hasErrors": false,
  *       "errors": [],
  *       "unPlannedUsers": [
  *        {
  *         "branch_name": branches.name,
  *         "name": users.name,
  *         "uren_max": users.uren_max,
  *         "uren_min": users.uren_min,
  *         "username": users.username
  *        }
  *       ],
  *       "events": [
  *         {
  *           "name": users.name,
  *           "title": event_name,
  *           "branch_name": branches.name,
  *           "user_id": users.id,
  *           "branch_id": branches.id,
  *           "start": events.start,
  *           "end": events.end,
  *           "event_id": events.id,
  *           "active": 1
  *         }
  *       ]
  *     }
  *
  * @apiError Unauthorized No access or input validation errors
  *
  * @apiErrorExample Error-Response:
  *     HTTP/1.1 403 Not Found
  *     {
  *       "hasErrors": true,
  *       "errors": [errors]
  *     }
  */

  /**
   * @api {get} /events-user/timestamp/{start}/{end} Events for User
   * @apiVersion 1.0.0
   * @apiName Events for User
   * @apiGroup Events
   *
   * @apiParam {String} api_token user.api_token
   * @apiParam {Timestamp} start unix time
   * @apiParam {Timestamp} end unix time
   *
   * @apiSuccess {Boolean} hasErrors  true or false
   * @apiSuccess {Object} errors  Object with errors, if there are any
   * @apiSuccess {Object} events  Array with events.
   *
   * @apiSuccessExample Success-Response:
   *     HTTP/1.1 200 OK
   *     {
   *       "hasErrors": false,
   *       "errors": [],
   *       "events": [
   *         {
   *           "name": users.name,
   *           "title": event_name,
   *           "branch_name": branches.name,
   *           "user_id": users.id,
   *           "branch_id": branches.id,
   *           "start": events.start,
   *           "end": events.end,
   *           "event_id": events.id,
   *           "active": 1
   *         }
   *       ]
   *     }
   *
   * @apiError Unauthorized No access or input validation errors
   *
   * @apiErrorExample Error-Response:
   *     HTTP/1.1 403 Not Found
   *     {
   *       "hasErrors": true,
   *       "errors": [errors]
   *     }
   */

 /**
  * @api {post} /events/activate Activate Events
  * @apiVersion 1.0.0
  * @apiName Activate Events
  * @apiGroup Events
  *
  * @apiParam {String} api_token user.api_token
  * @apiParam {Timestamp} start unix time
  * @apiParam {Timestamp} end unix time
  *
  * @apiSuccess {Boolean} hasErrors  true or false
  * @apiSuccess {Object} errors  Object with errors, if there are any
  *
  * @apiSuccessExample Success-Response:
  *     HTTP/1.1 200 OK
  *     {
  *       "hasErrors": false,
  *       "errors": []
  *     }
  *
  * @apiError Unauthorized No access or input validation errors
  *
  * @apiErrorExample Error-Response:
  *     HTTP/1.1 403 Not Found
  *     {
  *       "hasErrors": true,
  *       "errors": [errors]
  *     }
  */


 /**
  * @api {post} /edit/event Edit Event
  * @apiVersion 1.0.0
  * @apiName Edit Event
  * @apiGroup Events
  *
  * @apiParam {String} api_token user.api_token
  * @apiParam {Date} start 2017-12-11 12:00:00
  * @apiParam {Date} end 2017-12-11 12:00:00
  * @apiParam {Integer} event_id id of event to edit
  *
  * @apiSuccess {Boolean} hasErrors  true or false
  * @apiSuccess {Object} errors  Object with errors, if there are any
  * @apiSuccess {Object} event   Created event info
  *
  * @apiSuccessExample Success-Response:
  *     HTTP/1.1 200 OK
  *     {
  *       "hasErrors": false,
  *       "errors": {}
  *       "event": {
  *           "start": event.start,
  *           "end": event.end,
  *           "branch_id": event.branch_id,
  *           "user_id": event.user_id,
  *           "active": false
  *       }
  *     }
  *
  * @apiError Unauthorized No access or input validation errors
  *
  * @apiErrorExample Error-Response:
  *     HTTP/1.1 403 Not Found
  *     {
  *       "hasErrors": true,
  *       "errors": {errors}
  *     }
  */

 /**
  * @api {post} /delete/event Delete Event
  * @apiVersion 1.0.0
  * @apiName Delete Event
  * @apiGroup Events
  *
  * @apiParam {String} api_token user.api_token
  * @apiParam {Integer} event_id id of the event to delete
  *
  * @apiSuccess {Boolean} hasErrors  true or false
  * @apiSuccess {Object} errors  Object with errors, if there are any
  *
  * @apiSuccessExample Success-Response:
  *     HTTP/1.1 200 OK
  *     {
  *       "hasErrors": false,
  *       "errors": {}
  *     }
  *
  * @apiError Unauthorized No access or input validation errors
  *
  * @apiErrorExample Error-Response:
  *     HTTP/1.1 403 Not Found
  *     {
  *       "hasErrors": true,
  *       "errors": {errors}
  *     }
  */
