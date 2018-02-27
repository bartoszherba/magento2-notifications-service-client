define(['jquery'], function ($) {
    "use strict";

    return function (accountId, id) {
        return $.ajax('http://localhost:3000/message', {
            method: 'delete',
            data: {
                accountId: accountId,
                _id: id
            }
        });
    }
});
