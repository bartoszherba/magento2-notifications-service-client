define(['jquery'], function ($) {
    "use strict";

    return function (options) {
        const [messages, hostname] = options;
        return $.ajax(hostname + '/message/update', {
            method: 'patch',
            data: {
                updates: messages
            }
        });
    }
});
