!function(e){var t={};function n(a){if(t[a])return t[a].exports;var o=t[a]={i:a,l:!1,exports:{}};return e[a].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(a,o,function(t){return e[t]}.bind(null,o));return a},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=1)}({1:function(e,t,n){e.exports=n("SyjZ")},SyjZ:function(e,t){function n(e){if(e){var t={video:document.getElementById("preview"),mirror:!1};window.URL.createObjectURL=function(e){return t.video.srcObject=e,e};var n=new Instascan.Scanner(t);Instascan.Camera.getCameras().then((function(t){t.length>0?(n.start(t[e]),$("#scanModal").modal("show")):console.error("No cameras found.")})).catch((function(e){console.error(e)})),n.addListener("scan",(function(e){var t;t=e,$.ajax({url:"getuser",type:"POST",data:{qr:t},success:function(e){$("#scanModal").modal("hide"),e?$.ajax({url:"getUserCredit",type:"POST",data:{userId:e.id,ctrl:a(new Date)},success:function(t){t?($("#empId").val(e.id),$("#empNum").val(e.uname),$("#empName").val(e.name),$("#empDept").val(e.department_id?e.department.name:"N/A"),$("#msg").addClass("d-none"),$(".scan").removeClass("d-none")):(o(),Swal.fire({icon:"error",title:"User credit not available",text:"Please contact SPI-IAD Dept."}))}}):(o(),Swal.fire({icon:"error",title:"QR Code does not exist in the database.",text:"Please contact SPI-IAD Dept."}))}}),n.stop().then((function(){$("#scanModal").modal("hide")}))})),$("#scanModal").on("hide.bs.modal",(function(e){n.stop()}))}else iziToast.warning({title:"Warning",message:"Please select camera first.",position:"topCenter",close:!1,pauseOnHover:!1})}function a(e){var t="SPI"+(e=new Date).getFullYear()+("0"+(e.getMonth()+1)).slice(-2);return e.getDate()<=15?t+="A":t+="B",t}function o(){$("#msg").removeClass("d-none"),$(".scan").addClass("d-none"),$("#amount").removeClass("is-invalid"),$("#amount").val("0")}$(document).ready((function(){navigator.mediaDevices.getUserMedia({video:!0}).then((function(e){Instascan.Camera.getCameras().then((function(e){if(e.length>0)$("#cameraSelect option[value='check']").remove(),$("#cameraSelect").prop("disabled",!1),$.each(e,(function(e,t){var n=document.createElement("option");n.value=e,n.text=t.name,$("#cameraSelect").prepend(n)})),$("#cameraSelect").val(e.length-1);else{$("#cameraSelect option[value='check']").remove();var t=document.createElement("option");t.text="No cameras found.",$("#cameraSelect").append(t),$("#cameraSelect").prop("disabled",!0),console.error("No cameras found.")}})).catch((function(e){console.error(e)}))})).catch((function(e){if("NotAllowedError"===e.name){$("#cameraSelect option[value='check']").remove();var t=document.createElement("option");t.text="Camera "+e.message,$("#cameraSelect").append(t),$("#cameraSelect").prop("disabled",!0),$("#msg").css("color","red"),$("#msg").text("*** PLEASE ALLOW PERMISSION TO USE CAMERA ***")}console.error(e.name)}))})),$("#scanqrBtn").on("click",(function(){n($("#cameraSelect").val())})),$("#transactBtn").on("click",(function(e){empId=$("#empId").val(),empName=$("#empName").val(),ctrl=a(new Date),amnt=$("#amount").val(),0!=$("#amount").val()?Swal.fire({title:"Are you sure?",html:"<span style='font-size:2rem'><span class='text-info'>Php "+amnt+"</span> will be deducted.</span>",icon:"question",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Confirm"}).then((function(e){e.isConfirmed&&function(e,t,n){$.ajax({url:"transact",type:"POST",data:{userId:e,ctrl:t,amount:n},success:function(e){1==e.status?(o(),Swal.fire({icon:"success",title:e.result})):Swal.fire({icon:"error",title:e.result})}})}(empId,ctrl,amnt)})):$("#amount").addClass("is-invalid")}))}});
//# sourceMappingURL=canteen.js.map