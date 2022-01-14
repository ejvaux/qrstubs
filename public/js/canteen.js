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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/canteen.js":
/*!*********************************!*\
  !*** ./resources/js/canteen.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $("#wait").css("display", "block");
  navigator.mediaDevices.getUserMedia({
    video: true
  }).then(function (stream) {
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        $("#cameraSelect option[value='check']").remove();
        $("#cameraSelect").prop('disabled', false);
        $.each(cameras, function (i, val) {
          var opt = document.createElement('option');
          opt.value = i;
          opt.text = val.name;
          $("#cameraSelect").prepend(opt);
        });
        $("#cameraSelect").val(cameras.length - 1);
      } else {
        $("#cameraSelect option[value='check']").remove();
        var opt = document.createElement('option');
        opt.text = "No cameras found.";
        $("#cameraSelect").append(opt);
        $("#cameraSelect").prop("disabled", true);
        console.error('No cameras found.');
      }

      stream.getTracks().forEach(function (track) {
        track.stop();
      });
      $("#wait").css("display", "none");
    })["catch"](function (e) {
      console.error(e);
      $("#wait").css("display", "none");
    });
    stream.getTracks().forEach(function (track) {
      track.stop();
    });
  })["catch"](function (err) {
    if (err.name === 'NotAllowedError') {
      $("#cameraSelect option[value='check']").remove();
      var opt = document.createElement('option');
      opt.text = "Camera " + err.message;
      $("#cameraSelect").append(opt);
      $("#cameraSelect").prop("disabled", true);
      $('#msg').css('color', 'red');
      $('#msg').text('*** PLEASE ALLOW PERMISSION TO USE CAMERA ***');
    }

    console.error(err.name);
    $("#wait").css("display", "none");
  }); //$('#msg').text(generateControlNum(new Date()));
});
/* * * * * * FUNCTIONS * * * * * */

function loadcam(i) {
  if (i) {
    var args = {
      video: document.getElementById('preview'),
      mirror: false
    };

    window.URL.createObjectURL = function (stream) {
      args.video.srcObject = stream;
      return stream;
    };

    var scanner = new Instascan.Scanner(args);
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[i]);
        $("#scanModal").modal('show');
      } else {
        console.error('No cameras found.');
      }
    })["catch"](function (e) {
      console.error(e);
    });
    scanner.addListener('scan', function (c) {
      loadUser(c);
      scanner.stop().then(function () {
        $("#scanModal").modal('hide');
      });
    });
    $('#scanModal').on('hide.bs.modal', function (event) {
      scanner.stop();
    });
  } else {
    iziToast.warning({
      title: 'Warning',
      message: 'Please select camera first.',
      position: 'topCenter',
      close: false,
      pauseOnHover: false
    });
  }
}

;

function loadUser(qr) {
  /*$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });*/
  $.ajax({
    url: 'getuser',
    type: 'POST',
    data: {
      'qr': qr
    },
    success: function success(data) {
      $("#scanModal").modal('hide');

      if (data) {
        $.ajax({
          url: 'getUserCredit',
          type: 'POST',
          //global: false,
          data: {
            'userId': data.id,
            'ctrl': generateControlNum(new Date())
          },
          success: function success(data2) {
            if (data2) {
              $('#empId').val(data.id);
              $('#empNum').val(data.uname);
              $('#empName').val(data.name);
              $('#empDept').val(data.department_id ? data.department.name : "N/A");
              $('#msg').addClass('d-none');
              $('.scan').removeClass('d-none');
            } else {
              reset();
              Swal.fire({
                icon: 'error',
                title: 'User credit not available',
                text: 'Please contact SPI-IAD Dept.'
              });
            }
          }
        });
      } else {
        reset();
        Swal.fire({
          icon: 'error',
          title: 'User disabled or does not exist in the database.',
          text: 'Please contact SPI-IAD Dept.'
        });
      }
    }
  });
}

function checkCredit(userId, ctrl) {
  $.ajax({
    url: 'getUserCredit',
    type: 'POST',
    //global: false,
    data: {
      'userId': userId,
      'ctrl': ctrl
    },
    success: function success(data) {
      return data;
    }
  });
}

function transact(userId, ctrl, amount) {
  //alert(userId+"-"+ctrl+"-"+amount);
  $.ajax({
    url: 'transact',
    type: 'POST',
    //global: false,
    data: {
      'userId': userId,
      'ctrl': ctrl,
      'amount': amount
    },
    success: function success(data) {
      /*alert(data);*/
      if (data.status == 1) {
        window.livewire.emit('addCanteenTransaction', data.transaction);
        reset();
        /*Swal.fire({
            icon: 'success',
            title: data.result,
        });*/

        iziToast.success({
          message: data.result
        });
        console.log(data.transaction);
      } else {
        //reset();
        Swal.fire({
          icon: 'error',
          title: data.result //text: 'Please contact SPI-IAD Dept.'

        });
      }
    }
  });
  /*reset();
  Swal.fire({
      icon: 'success',
      title: 'Transaction Completed.'
  });*/
}

function generateControlNum(date) {
  var date = new Date();
  var con = "SPI" + date.getFullYear() + ("0" + (date.getMonth() + 1)).slice(-2);

  if (date.getDate() <= 15) {
    con = con + "A";
  } else {
    con = con + "B";
  }

  return con;
}

function reset() {
  $('#msg').removeClass('d-none');
  $('.scan').addClass('d-none');
  $('#amount').removeClass('is-invalid');
  $('#amount').val(''); //$('.invalid-feedback').hide();
}
/* * * * * * EVENTS * * * * * */


$('#scanqrBtn').on('click', function () {
  loadcam($("#cameraSelect").val()); //$("#scanModal").modal('show');
});
$('#transactBtn').on('click', function (event) {
  empId = $('#empId').val();
  empName = $('#empName').val();
  ctrl = generateControlNum(new Date());
  amnt = $('#amount').val();

  if ($('#amount').val() != 0) {
    Swal.fire({
      title: 'Are you sure?',

      /*html: "<span style='font-size:2rem'><span class='text-info'>Php "+amnt+"</span> will be deducted to <span class='text-info'>"+empName+"</span></span>",*/
      html: "<span style='font-size:2rem'><span class='text-info'>Php " + amnt + "</span> will be deducted.</span>",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm'
    }).then(function (result) {
      if (result.isConfirmed) {
        transact(empId, ctrl, amnt);
      }
    }); //transact($('#empId').val(),generateControlNum(new Date()),$('#amount').val());
  } else {
    $('#amount').addClass('is-invalid');
  }
});

/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./resources/js/canteen.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\qrstubs\resources\js\canteen.js */"./resources/js/canteen.js");


/***/ })

/******/ });