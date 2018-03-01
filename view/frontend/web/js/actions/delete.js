define(['jquery'], function ($) {
    "use strict";

    return function (options) {
        const [identifier, messageId, hostname] = options;

        return $.ajax(hostname + '/message', {
            method: 'delete',
            data: {
                identifier: identifier,
                _id: messageId
            }
        });
    }
});
