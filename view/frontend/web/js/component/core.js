define([
        'jquery',
        'uiComponent',
        'ko',
        './socket',
    ], function ($, Component, ko, Socket) {
        'use strict';

        return Component.extend({
            isConnected: ko.observable(false),
            initialize: function () {
                this._super();
                this.socket = new Socket(this.options.endpoint, {
                    query: {
                        accountId: this.accountId,
                    },
                });

                this.socket.on('connect', () => {
                    this.isConnected(true);
                });

                this.socket.on('new-message', (response) => {
                    return this.handleNewMessage(response);
                });

                this.socket.on('new-message-list', (list) => {
                    return this.handleNewMessageList(list);
                });

                this.removeMsg = (data, evt) => {
                    this.handleRemoveMsg(data, evt);
                }
            },

            handleRemoveMsg: function (data) {
                return true;
            },
            handleNewMessage: function (response) {
                return true;
            },
            handleNewMessageList: function (list) {
                return true;
            }
        });
    }
);
