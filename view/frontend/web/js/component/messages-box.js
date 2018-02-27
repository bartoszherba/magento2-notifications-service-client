define([
        'jquery',
        'uiComponent',
        'ko',
        './socket',
        '../actions/delete'
    ], function ($, Component, ko, Socket, deleteAction) {
        'use strict';

        let msgCount = ko.observable(0);
        let messages = ko.observableArray([]);
        let visible = ko.observable(false);

        const toggle = () => {
            visible(!visible());
        };

        const removeMsg = function (data, evt) {
            console.log(evt.currentTarget);
            deleteAction(2, data._id).done((response) => {

                msgCount(msgCount() - response.deleted.n);
                for (let i = 0; i < messages().length; i++) {
                    if (messages()[i]._id === data._id) {
                        const tmpMessages = messages();
                        tmpMessages.splice(i, 1);
                        messages(tmpMessages);
                    }
                }
            }).fail((jqXHR, err) => {
                console.log(err);
            });
        };

        const isEmpty = ko.computed(() => {
            return messages().length === 0;
        });

        return Component.extend({
            msgCount: msgCount,
            messages: messages,
            visible: visible,
            isEmpty: isEmpty,
            initialize: function () {
                this._super();

                this.socket = new Socket({hostname: 'localhost', port: '3000', accountId: 2});

                this.socket.on('new-message', (response) => {
                    this.messages.push(response.newMsg);
                    this.msgCount(response.total);
                });

                this.socket.on('new-message-list', (list) => {
                    list = list.filter((item) => {
                        return item.status === 'Unread';
                    });

                    this.msgCount(list.length);
                    this.messages(list);
                });
            },
            removeMsg: removeMsg,
            toggle: toggle
        });
    }
);
