define(['socketio'], function (io) {
    return function (options) {
        const {hostname, port, accountId} = options;

        socket = io(hostname + ':' + port, {
            query: {
                accountId: accountId,
            }
        });

        return socket;
    };
});
