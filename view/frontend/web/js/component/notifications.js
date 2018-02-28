define([
        'jquery',
        'ko',
        './core',
        '../actions/delete'
    ], function ($, ko, Core, deleteAction) {
        'use strict';

        const removeNotification = function (notifications, id) {
            for (let i = 0; i < notifications().length; i++) {
                if (notifications()[i]._id === id) {
                    const tmpMessages = notifications();
                    tmpMessages.splice(i, 1);
                    notifications(tmpMessages);
                }
            }
        };

        return Core.extend({
            initialize: function () {
                this._super();
                this.notifications = ko.observableArray([]);
            },
            handleNewMessage: function (response) {
                const newMsg = response.newMsg;

                /**
                 * Only the owner of the account should see new message
                 */
                if (this.accountId === newMsg.accountId) {
                    this.notifications.push(newMsg);

                    if (this.isNotificationOnlyMode()) {
                        deleteAction([this.accountId, newMsg._id, this.options.endpoint]).fail((jqXHR, err) => {
                            console.log(err);
                        });
                    }

                    setTimeout(() => {
                        this.handleRemoveMsg(newMsg);
                    }, this.options.timeout);
                }
            },
            handleRemoveMsg: function (data) {
                $('#' + data._id).fadeOut(this.options.fadeOutTime, () => {
                    removeNotification(this.notifications, data._id);
                });
            },
            isNotificationOnlyMode: function () {
                return this.options.mode === 3;
            }
        });
    }
);
