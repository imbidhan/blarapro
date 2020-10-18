(function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define("/forms/validation", ["jquery", "Site"], factory);
    } else if (typeof exports !== "undefined") {
        factory(require("jquery"), require("Site"));
    } else {
        var mod = {
            exports: {}
        };
        factory(global.jQuery, global.Site);
        global.formsValidation = mod.exports;
    }
})(this, function (_jquery, _Site) {
    "use strict";

    _jquery = babelHelpers.interopRequireDefault(_jquery);
    (0, _jquery.default)(document).ready(function ($$$1) {
        (0, _Site.run)();
    }); // Example Validataion Full
    // ------------------------

    (function () {
        (0, _jquery.default)('#exampleFullForm').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#validateButton1',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Username is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_-]+$/,
                            //regexp: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+$/g
                        }
                    }
                },

                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Phone number is required'
                        },
                    }
                },

            },
            err: {
                clazz: 'invalid-feedback'
            },
            control: {
                // The CSS class for valid control
                valid: 'is-valid',
                // The CSS class for invalid control
                invalid: 'is-invalid'
            },
            row: {
                invalid: 'has-danger'
            }
        });
    })(); // Example Validataion Constraints
    // -------------------------------


});
