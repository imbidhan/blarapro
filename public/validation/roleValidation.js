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
          name: {
            validators: {
              notEmpty: {
                message: 'The role name is required'
              },
            }
          },
          description: {
            validators: {
              notEmpty: {
                message: 'The role description is required'
              },
              stringLength: {
                max: 200
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