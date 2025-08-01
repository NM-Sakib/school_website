
// function showToast(option) {
//   var wrapper = $(option.eleWrapper);
//   var toast = createToast(option);
//   toast = $(toast).hide().fadeIn(750);
//   if (option.autoClose) {
//       var outTime = option.autoCloseTime || 3500;
//       if (outTime < 1000) {
//           outTime = 1000;
//       }
//       var watch = setTimeout(function() {
//           toast.animate({
//               'margin-top': '-50px',
//               'opacity': '0'
//           }, 500, function() {
//               this.remove();
//               if (option.afterClose) {
//                   option.afterClose();
//               }
//           })
//       }, outTime);
//   }




//   $(wrapper).on('click', '.hs-close', function() {
//       $(this).closest('.hs-toast').remove();
//       //clearTimeout(watch);
//       if (option.afterClose) {
//           option.afterClose();
//       }
//   });

//   $(wrapper).append(toast);
//   if (option.afterShow) {
//       option.afterShow();
//   }
// }


function showToast(option) {
    var wrapper = $(option.eleWrapper);
    var toast = createToast(option);
    
    // Initial styling for animation
    toast = $(toast).css({
        display: 'none',
        opacity: 0,
        transform: 'scale(0.8)',
        transition: 'all 0.4s ease',
        'box-shadow': '0 8px 20px rgba(0,0,0,0.15)',
        'border-radius': '8px'
    });

    // Append first, then trigger animation
    $(wrapper).append(toast);
    setTimeout(() => {
        toast.css({
            display: 'block',
            opacity: 1,
            transform: 'scale(1.0)'
        });
    }, 10); // slight delay to trigger transition

    if (option.autoClose) {
        let outTime = option.autoCloseTime || 3500;
        outTime = Math.max(outTime, 1000);

        var watch = setTimeout(() => {
            toast.css({
                transform: 'translateY(-40px) scale(0.9)',
                opacity: 0
            });
            setTimeout(() => {
                toast.remove();
                if (option.afterClose) option.afterClose();
            }, 500);
        }, outTime);
    }

    // Close button event
    $(wrapper).on('click', '.hs-close', function () {
        const parentToast = $(this).closest('.hs-toast');
        parentToast.css({
            transform: 'translateX(30px) scale(0.9)',
            opacity: 0
        });
        setTimeout(() => {
            parentToast.remove();
            if (option.afterClose) option.afterClose();
        }, 400);
    });

    if (option.afterShow) {
        option.afterShow();
    }
}

function createToast(option) {
  var final = toastCaseValidation(option);
  var html = `
         <div class="hs-toast hs-theme-` + (option.theme).toLowerCase() + `">
          <div class="hs-toast-inner">                
            <div class="hs-toast-icons">
              ` + final.icon + `
            </div>
            <div class="hs-toast-msg">
              ` + final.msg + `
            </div>
            
          </div>
         </div>`;
  return html;
}

function toastCaseValidation(option) {
  var finalOption = {};
  var toastmsg;
  var themeIco;
  var closeBtn = '<button type="button" class="hs-close">&#10006;</button>';
  switch (option.theme) {
      case 'error':
          themeIco = '<svg aria-hidden="true" focusable="false"  xmlns="http://www.w3.org/2000/svg" width="1.875em" height="1.875em" viewBox="0 0 30 30"> <circle fill="#E63435" stroke="#E63435" stroke-width="2"  cx="50%" cy="50%" r="13" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset" from="100" to="0" dur="0.9s" /> </circle> <line fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"  x1="10.5" y1="10.5" x2="19.5" y2="19.5" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="4s" /> </line> <line fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"  x1="19.5" y1="10.5" x2="10.5" y2="19.5" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="4s" /> </line> </svg>';
          break;
      case 'success':
          themeIco = '<svg aria-hidden="true" focusable="false"  xmlns="http://www.w3.org/2000/svg" width="1.875em" height="1.875em" viewBox="0 0 30 30"> <circle fill="#2DD743" stroke="#2DD743" stroke-width="2" cx="50%" cy="50%" r="13" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset" from="100" to="0" dur="0.9s" /> </circle> <polyline fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" points="8,17 13,21 22,10" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="4s" /> </polyline> </svg>';
          break;
      case 'warning':
          themeIco = '<svg aria-hidden="true" focusable="false"  xmlns="http://www.w3.org/2000/svg" width="1.875em" height="1.875em" viewBox="0 0 30 30" > <path  d="M 13 2 Q 15,0 17,2 L 26,23 Q 26,26 23,26 L 6,26 Q 2,26 3,22 L 13,2" stroke="#F29208" stroke-width="2" fill="#F29208" stroke-linecap="round" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="0.9s" /> </path> <line  fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" x1="15" y1="9" x2="15" y2="17" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="5s" /> </line> <line  fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" x1="15" y1="21" x2="15" y2="22" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="5s" /> </line> </svg>';
          break;
      default:
          themeIco = '<svg aria-hidden="true" focusable="false"  xmlns="http://www.w3.org/2000/svg" width="1.875em" height="1.875em" viewBox="0 0 30 30"> <circle fill="#42C0F2" stroke="#42C0F2" stroke-width="2" cx="50%" cy="50%" r="13" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset" from="100" to="0" dur="0.9s" /> </circle> <line fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" x1="15" y1="9" x2="15" y2="9" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="6s" /> </line> <line fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" x1="15" y1="15" x2="15" y2="22" stroke-dasharray="100"> <animate attributeName="stroke-dashoffset"  from="100" to="0" dur="6s" /> </line> </svg>';
  }
  if (option.closeButton == false) {
      closeBtn = '';
  }

  if (option.msg == undefined) {
      toastmsg = 'No Message';
  } else {
      if (option.msg.length != 1 && typeof option.msg === "object") {
          toastmsg = '<ul>';
          option.msg.forEach(function(val, index) {
              toastmsg = toastmsg + '<li>' + val + '</li>';
          });
          toastmsg = toastmsg + '</ul>';
      } else {
          toastmsg = option.msg;
      }
  }
  finalOption.icon = themeIco;
  finalOption.close = closeBtn;
  finalOption.msg = toastmsg;
  return finalOption;
}

{/* <div class="hs-toast-action">
              ` + final.close + `
            </div> */}