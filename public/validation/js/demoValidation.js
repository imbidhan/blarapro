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
          rolename: {
            validators: {
              notEmpty: {
                message: 'The role name is required'
              },
              stringLength: {
                min: 6,
                max: 30
              },
              regexp: {
                regexp: /^[a-zA-Z0-9]+$/
              }
            }
          },

          email: {
            validators: {
              notEmpty: {
                message: 'The username is required'
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
              }
            }
          },
          birthday: {
            validators: {
              notEmpty: {
                message: 'The birthday is required'
              },
              date: {
                format: 'YYYY/MM/DD'
              }
            }
          },
          github: {
            validators: {
              url: {
                message: 'The url is not valid'
              }
            }
          },
          skills: {
            validators: {
              notEmpty: {
                message: 'The skills is required'
              },
              stringLength: {
                max: 300
              }
            }
          },
          porto_is: {
            validators: {
              notEmpty: {
                message: 'Please specify at least one'
              }
            }
          },
          'for[]': {
            validators: {
              notEmpty: {
                message: 'Please specify at least one'
              }
            }
          },
          company: {
            validators: {
              notEmpty: {
                message: 'Please company'
              }
            }
          },
          browsers: {
            validators: {
              notEmpty: {
                message: 'Please specify at least one browser you use daily for development'
              }
            }
          }
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