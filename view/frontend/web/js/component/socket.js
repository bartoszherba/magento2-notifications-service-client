define(['jquery', 'socketio'], function ($, io) {
    const defaults = {
        forceNew: true,
        reconnectionAttempts: 5
    };

    return function (hostname, options) {
        options = $.extend({}, defaults, options);
        socket = io(hostname, options);

        return socket;
    };
});
