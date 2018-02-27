define(['jquery'], function ($) {
    "use strict";

    return function (accountId, id) {
        return $.ajax('http://localhost:3000/message', {
            method: 'delete',
            data: {
                accountId: 2,
                _id: id
            }
        });
    }
});
