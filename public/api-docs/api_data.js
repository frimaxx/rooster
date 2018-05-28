define({ "api": [  {    "type": "post",    "url": "/login",    "title": "Login",    "version": "1.0.0",    "name": "Login",    "group": "Auth",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "username",            "description": "<p>username or email of user</p>"          },          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "password",            "description": "<p>password of user</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "status",            "description": "<p>success or error</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "data",            "description": "<p>User profile information.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"status\": \"success\",\n  \"data\": {\n      \"id\": user.id,\n      \"username\": user.username,\n      \"email\": user.email,\n      \"api_token\": user.api_token,\n      \"company\" => {\n         \"id\": company.id,\n         \"name\": company.name,\n         \"city\": company.city,\n         \"postal_code\": company.postal_code,\n         \"address\": company.address,\n         \"logo_url\": company.logo,\n         \"base_64_logo\": company.logo.base64\n         \"primary_color\": company.primary_color,\n         \"seconday_color\": company.seconday_color,\n         \"created_at\": company.created_at,\n         \"updated_at\": company.updated_at\n      }\n  }\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>Invalid username or password</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"status\": \"error\",\n  \"message\": \"Invalid username or password\"\n}",          "type": "json"        }      ]    },    "filename": "api-docs/auth.js",    "groupTitle": "Auth"  },  {    "type": "get",    "url": "/",    "title": "BaseEndpoint",    "version": "1.0.0",    "name": "Base_Endpoint",    "group": "Base",    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "inspiration",            "description": "<p>Inspirational quote</p>"          },          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "heartBeat",            "description": "<p>Time it took to process the request</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"inspiration\": \"Simplicity is an acquired taste. - Katharine Gerould\",\n  \"heartBeat\": \"99.51 ms\"\n}",          "type": "json"        }      ]    },    "filename": "api-docs/home.js",    "groupTitle": "Base"  },  {    "type": "post",    "url": "/events/activate",    "title": "Activate Events",    "version": "1.0.0",    "name": "Activate_Events",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "start",            "description": "<p>unix time</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "end",            "description": "<p>unix time</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": []\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": [errors]\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "get",    "url": "/events-branch/copy-last-week/{start}/{end}",    "title": "Copy Events from last week",    "version": "1.0.0",    "name": "Copy_from_last_week",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "start",            "description": "<p>unix time</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "end",            "description": "<p>unix time</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "duplicatedEvents",            "description": "<p>Array with events.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": [],\n  \"duplicatedEvents\": [\n    {\n      \"user_id\": users.name,\n      \"branch_id\": branches.id,\n      \"start\": events.start,\n      \"end\": events.end,\n      \"event_id\": events.id,\n      \"active\": 0\n    }\n  ]\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": [errors]\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "post",    "url": "/delete/event",    "title": "Delete Event",    "version": "1.0.0",    "name": "Delete_Event",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Integer",            "optional": false,            "field": "event_id",            "description": "<p>id of the event to delete</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": {}\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": {errors}\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "post",    "url": "/edit/event",    "title": "Edit Event",    "version": "1.0.0",    "name": "Edit_Event",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Date",            "optional": false,            "field": "start",            "description": "<p>2017-12-11 12:00:00</p>"          },          {            "group": "Parameter",            "type": "Date",            "optional": false,            "field": "end",            "description": "<p>2017-12-11 12:00:00</p>"          },          {            "group": "Parameter",            "type": "Integer",            "optional": false,            "field": "event_id",            "description": "<p>id of event to edit</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "event",            "description": "<p>Created event info</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": {}\n  \"event\": {\n      \"start\": event.start,\n      \"end\": event.end,\n      \"branch_id\": event.branch_id,\n      \"user_id\": event.user_id,\n      \"active\": false\n  }\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": {errors}\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "get",    "url": "/events-user/timestamp/{start}/{end}",    "title": "Events for User",    "version": "1.0.0",    "name": "Events_for_User",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "start",            "description": "<p>unix time</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "end",            "description": "<p>unix time</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "events",            "description": "<p>Array with events.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": [],\n  \"events\": [\n    {\n      \"name\": users.name,\n      \"title\": event_name,\n      \"branch_name\": branches.name,\n      \"user_id\": users.id,\n      \"branch_id\": branches.id,\n      \"start\": events.start,\n      \"end\": events.end,\n      \"event_id\": events.id,\n      \"active\": 1\n    }\n  ]\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": [errors]\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "get",    "url": "/events-branch/timestamp/{start}/{end}",    "title": "Events for current branch",    "version": "1.0.0",    "name": "Events_for_current_branch",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "start",            "description": "<p>unix time</p>"          },          {            "group": "Parameter",            "type": "Timestamp",            "optional": false,            "field": "end",            "description": "<p>unix time</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "unPlannedUsers",            "description": "<p>Array with unplanned users.</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "events",            "description": "<p>Array with events.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": [],\n  \"unPlannedUsers\": [\n   {\n    \"branch_name\": branches.name,\n    \"name\": users.name,\n    \"uren_max\": users.uren_max,\n    \"uren_min\": users.uren_min,\n    \"username\": users.username\n   }\n  ],\n  \"events\": [\n    {\n      \"name\": users.name,\n      \"title\": event_name,\n      \"branch_name\": branches.name,\n      \"user_id\": users.id,\n      \"branch_id\": branches.id,\n      \"start\": events.start,\n      \"end\": events.end,\n      \"event_id\": events.id,\n      \"active\": 1\n    }\n  ]\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": [errors]\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "post",    "url": "/new/event",    "title": "New Event",    "version": "1.0.0",    "name": "New_Event",    "group": "Events",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          },          {            "group": "Parameter",            "type": "Date",            "optional": false,            "field": "start",            "description": "<p>2017-12-11 12:00:00</p>"          },          {            "group": "Parameter",            "type": "Date",            "optional": false,            "field": "end",            "description": "<p>2017-12-11 12:00:00</p>"          },          {            "group": "Parameter",            "type": "Integer",            "optional": false,            "field": "user_id",            "description": "<p>id of user for who the event is</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Boolean",            "optional": false,            "field": "hasErrors",            "description": "<p>true or false</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "errors",            "description": "<p>Object with errors, if there are any</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "event",            "description": "<p>Created event info</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"hasErrors\": false,\n  \"errors\": [],\n  \"event\": {\n      \"start\": event.start,\n      \"end\": event.end,\n      \"branch_id\": event.branch_id,\n      \"user_id\": event.user_id,\n      \"active\": false\n  }\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>No access or input validation errors</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"hasErrors\": true,\n  \"errors\": [errors]\n}",          "type": "json"        }      ]    },    "filename": "api-docs/event.js",    "groupTitle": "Events"  },  {    "type": "get",    "url": "/user/info",    "title": "UserInfo",    "version": "1.0.0",    "name": "UserInfo",    "group": "User",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "api_token",            "description": "<p>user.api_token</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "status",            "description": "<p>success or error</p>"          },          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "data",            "description": "<p>User profile information.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n{\n  \"status\": \"success\",\n  \"data\": {\n      \"username\": user.username,\n      \"email\": user.email,\n      \"api_token\": user.api_token,\n      \"company\": {\n         \"id\": company.id,\n         \"name\": company.name,\n         \"city\": company.city,\n         \"postal_code\": company.postal_code,\n         \"address\": company.address,\n         \"logo_url\": company.logo,\n         \"base_64_logo\": company.logo.base64\n         \"primary_color\": company.primary_color,\n         \"seconday_color\": company.seconday_color,\n         \"created_at\": company.created_at,\n         \"updated_at\": company.updated_at\n      }\n  }\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "Unauthorized",            "description": "<p>invalid api_token</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 403 Not Found\n{\n  \"status\": \"error\",\n  \"message\": \"Unauthorized\"\n}",          "type": "json"        }      ]    },    "filename": "api-docs/user.js",    "groupTitle": "User"  }] });
