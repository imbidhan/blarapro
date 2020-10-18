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
                siteNotice: {
                    validators: {
                        notEmpty: {
                            message: 'Site notice is required'
                        },
                    }
                },
                betMinimum: {
                    validators: {
                        notEmpty: {
                            message: 'Bet minimum is required'
                        },
                    }
                },
                betMaximum: {
                    validators: {
                        notEmpty: {
                            message: 'Bet maximum is required'
                        },
                    }
                },
                depositMinimum: {
                    validators: {
                        notEmpty: {
                            message: 'Deposit minimum is required'
                        },
                    }
                },
                depositMaximum: {
                    validators: {
                        notEmpty: {
                            message: 'Deposit maximum is required'
                        },
                    }
                },
                withdrawMinimum: {
                    validators: {
                        notEmpty: {
                            message: 'Withdraw Minimum is required'
                        },
                    }
                },
                withdrawMaximum: {
                    validators: {
                        notEmpty: {
                            message: 'Withdraw maximum is required'
                        },
                    }
                },
                clubRate: {
                    validators: {
                        notEmpty: {
                            message: 'Club rate is required'
                        },
                    }
                },
                sponsorRate: {
                    validators: {
                        notEmpty: {
                            message: 'Sponsor rate is required'
                        },
                    }
                },
                partialOne: {
                    validators: {
                        notEmpty: {
                            message: 'Partial one is required'
                        },
                    }
                },
                partialTwo: {
                    validators: {
                        notEmpty: {
                            message: 'Partial two is required'
                        },
                    }
                },
                clubWithdrawStatus: {
                    validators: {
                        notEmpty: {
                            message: 'Please specify one'
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
