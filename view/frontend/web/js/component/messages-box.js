define([
        'jquery',
        './core',
        '../actions/delete'
    ], function ($, Core, deleteAction) {
        'use strict';

        return Core.extend({
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
                        this.pop('pop');
                        setTimeout(() => {
                            this.pop('');
                        }, 1000);
                    } else {
                        this.removeMsg(newMsg);
                    }

                    console.log(this.messages());
                }
            },
            handleNewMessageList: function (list) {
                list = list.filter((item) => {
                    return item.status === 'Unread';
                });

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
            }
        });
    }
);
