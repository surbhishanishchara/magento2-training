define([
    'uiComponent',
    'ko'
], function(Component, ko) {
    return Component.extend({
        clock: ko.observable("Loading......."),
        initialize: function () {
            this._super();
            setInterval(this.reloadTime.bind(this), 1000);
        },
        reloadTime: function () {
            this.clock(Date());
        },
        getClock: function () {
            return this.clock;
        }
    });
});