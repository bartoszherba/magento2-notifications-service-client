define(['jquery'], function ($) {
    "use strict";

    return function (options) {
        const [messages, hostname] = options;
        return $.ajax(hostname + '/v1/message', {
            method: 'patch',
            dataType: 'json',
            data: {
                updates: messages
            }
        });
    }
});
