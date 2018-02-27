define([
        'jquery',
        'uiComponent',
        'ko',
        './socket',
    ], function ($, Component, ko, Socket) {
        'use strict';

        let messages = ko.observableArray([]);
        let msgCount = ko.computed(() => {
            return messages().length;
        });

        const isEmpty = ko.computed(() => {
            return messages().length === 0;
        });

        return Component.extend({
            msgCount: msgCount,
            messages: messages,
            visible: ko.observable(false),
            isEmpty: isEmpty,
            isConnected: ko.observable(false),
            pop: ko.observable(''),
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

                this.removeMsg = (data) => {
                    this.handleRemoveMsg(data);
                }
            },
            toggle: function () {
                this.visible(!this.visible());
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
