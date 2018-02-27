define([
        'jquery',
        './core',
        'ko',
    ], function ($, Core, ko) {
        'use strict';

        return Core.extend({
            initialize: function () {
                this.message = ko.observable('SUPER TEST');
                this._super();
            },
            processNewMessage: function (response) {
                const newMsg = response.newMsg;

                /**
                 * Only the owner of account should see new message
                 */
                if (this.accountId == newMsg.accountId) {
                    this.message(newMsg.message);
                }
            },
            processNewMessageList: function (list) {
                return true;
            }
        });
    }
);
