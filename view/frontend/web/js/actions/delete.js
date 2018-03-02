define(['jquery'], function ($) {
    "use strict";

    return function (options) {
        const [identifier, messageId, hostname] = options;

        return $.ajax(hostname + '/v1/message', {
            method: 'delete',
            data: {
                identifier: identifier,
                _id: messageId
            }
        });
    }
});
