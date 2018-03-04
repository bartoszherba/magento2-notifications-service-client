define(['jquery'], function ($) {
    "use strict";

    return function (messages) {

        return $.ajax('/rest/V1/notifications/update', {
            method: 'post',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({messages: JSON.stringify(messages)})
        });
    }
});
