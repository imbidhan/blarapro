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
          selector: '#exampleFullForm',
          disabled: 'disabled'
        },
        icon: null,
        fields: {
          name: {
            validators: {
              notEmpty: {
                message: 'The name is required'
              },
            }
          },
          phone: {
            validators: {
              notEmpty: {
                message: 'The phone number is required'
              },
            }
          },

          email: {
            validators: {
              notEmpty: {
                message: 'The email is required'
              },
              emailAddress: {
                message: 'The email address is not valid'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'The password is required'
              },
              stringLength: {
                min: 8
              },
              regexp: {
                //regexp: /^[a-zA-Z0-9]+$/,
                //regexp: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+$/g
              }
            }
          },
          password_confirmation: {
            validators: {
              notEmpty: {
                message: 'The confirm password is required'
              },
              stringLength: {
                min: 8
              },
              regexp: {
                  //regexp: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+$/g
              }
            }
          },
          role_id: {
            validators: {
              notEmpty: {
                message: 'Please specify at least one'
              }
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
