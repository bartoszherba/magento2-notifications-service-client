define(['jquery'], function ($) {
    "use strict";

    return function (options) {
        const [accountId, messageId, hostname] = options;

        return $.ajax(hostname + '/message', {
            method: 'delete',
            data: {
                accountId: accountId,
                _id: messageId
            }
        });
    }
});
