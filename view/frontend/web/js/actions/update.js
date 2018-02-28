define(['jquery'], function ($) {
    "use strict";

    return function (messages = []) {
        return $.ajax('http://localhost:3000/message/update', {
            method: 'patch',
            data: {
                updates: messages
            }
        });
    }
});
