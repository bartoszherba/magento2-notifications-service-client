define([
        'jquery',
        'ko',
        './core',
        '../actions/delete',
        '../actions/update',
    ], function ($, ko, Core, deleteAction, updateAction) {
        'use strict';

        const isPopLocked = ko.observable(false);
        const updateCounter = function (pop) {
            if (!isPopLocked()) {
                isPopLocked(true);
                pop('pop');
                setTimeout(() => {
                    pop('');
                    isPopLocked(false);
                }, 1000);
            }
        };

        let messages = ko.observableArray([]);

        let newMsgCount = ko.computed(() => {
            const initialVal = 0;
            return messages().reduce(function (count, message) {

                if (message.status === 'Unread') {
                    count += 1;
                }

                return count;
            }, initialVal);
        });

        const isEmpty = ko.computed(() => {
            return messages().length === 0;
        });

        return Core.extend({
            newMsgCount: newMsgCount,
            messages: messages,
            visible: ko.observable(false),
            isEmpty: isEmpty,
            pop: ko.observable(''),
            initialize: function () {
                this._super();
            },
            handleNewMessage: function (response) {
                const newMsg = response.newMsg;

                /**
                 * Only the owner of account should see new message
                 */
                if (this.accountId == newMsg.accountId) {
                    /**
                     * If flag isAlwaysKeepMessages is false then message will be instantly removed from service
                     */
                    if (this.options.isAlwaysKeepMessages) {
                        this.messages.push(newMsg);
                        updateCounter(this.pop);
                    } else {
                        this.removeMsg(newMsg);
                    }
                }
            },
            handleNewMessageList: function (list) {
                this.messages(list);
            },
            handleRemoveMsg: function (data) {
                deleteAction(this.accountId, data._id).done(() => {
                    for (let i = 0; i < this.messages().length; i++) {
                        if (this.messages()[i]._id === data._id) {
                            const tmpMessages = this.messages();
                            tmpMessages.splice(i, 1);
                            this.messages(tmpMessages);
                        }
                    }
                }).fail((jqXHR, err) => {
                    console.log(err);
                });
            },
            toggle: function () {
                this.visible(!this.visible());

                if (this.visible() && this.newMsgCount()) {
                    var updatedMessages = [];

                    this.messages().forEach((message) => {
                        message.status = 'Read';
                        updatedMessages.push(message);
                    });

                    updateAction(updatedMessages).done(() => {
                        this.messages(updatedMessages);
                    }).fail((jqXHR, err) => {
                        console.log(err);
                    });
                }
            },
        });
    }
);