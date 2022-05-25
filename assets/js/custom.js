// Akses Blockir kembali halaman semula
const backPage = document.querySelector('#backPage');
if (backPage) {
    backPage.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        window.history.back();
     })
}
