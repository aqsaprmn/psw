const flashMsg = document.querySelector('div.flash-message');
const flashAttr = flashMsg.getAttribute('data-massage');
const flashTitle = flashMsg.getAttribute('data-title');
const flashText = flashMsg.getAttribute('data-text');

if (flashAttr) {
    if (flashAttr === 'Berhasil') {
        Swal.fire({
            title : flashTitle,
            text : flashText,
            icon : 'success'
        });
    } else {
        Swal.fire({
            title : flashTitle,
            text : flashText,
            icon : 'warning'
        });
    }
    
}