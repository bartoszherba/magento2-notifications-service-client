define(['jquery'], function ($) {
    "use strict";

    return function (options) {
        const [identifier, messageId] = options;

        return $.ajax('/rest/V1/notifications/delete', {
            method: 'post',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                identifier: identifier,
                _id: messageId
            })
        });
    }
});
