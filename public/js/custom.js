/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* ---------- AJAX SETUP ---------- */
$.ajaxSetup({
  error: function error(XMLHttpRequest, textStatus, errorThrown) {
    var msg = '';
    var file = '';
    var line = '';

    if (XMLHttpRequest.responseText != null) {
      msg = XMLHttpRequest.responseJSON.message;
      file = XMLHttpRequest.responseJSON.file;
      line = XMLHttpRequest.responseJSON.line;
      console.log(XMLHttpRequest.responseText);
      console.log(XMLHttpRequest);
    }

    if (XMLHttpRequest.readyState == 4) {
      // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
      if (XMLHttpRequest.status == '419' || XMLHttpRequest.status == '401') {
        window.location.reload();
      } else {
        iziToast.warning({
          title: 'ERROR ' + XMLHttpRequest.status,
          message: XMLHttpRequest.statusText + '<br>' + msg + '<br>' + file + '<br>Line: ' + line
        });
      }
    } else if (XMLHttpRequest.readyState == 0) {
      // Network error (i.e. connection refused, access denied due to CORS, etc.)
      iziToast.warning({
        title: 'ERROR ' + XMLHttpRequest.status,
        message: 'Network Error'
      });
    } else {
      iziToast.warning({
        title: 'ERROR',
        message: 'Unknown Error'
      }); // something weird is happening
    }
  },
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(document).ready(function () {
  $(document).ajaxStart(function () {
    $("#wait").css("display", "block");
  });
  $(document).ajaxComplete(function () {
    $("#wait").css("display", "none");
  });
  $('.select2').select2({
    width: '100%'
  });
  iziToast.settings({
    position: 'topCenter',
    close: false,
    pauseOnHover: true
  });
});

function downloadWait(btn) {
  i = 15;
  $(btn).attr('disabled', true);
  var t = setInterval(function () {
    if (i > 0) {
      $(btn).html('The download will start shortly ' + ('0' + i).slice(-2));
      i--;
    } else {
      clearInterval(t);
      $(btn).attr('disabled', false);
      $(btn).html('Re-download');
    }
  }, 1000);
}

/***/ }),

/***/ 3:
/*!**************************************!*\
  !*** multi ./resources/js/custom.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\qrstubs\resources\js\custom.js */"./resources/js/custom.js");


/***/ })

/******/ });