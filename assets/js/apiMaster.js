const kategori = document.getElementById('kategori');

if (kategori) {
    const btnDelKate = kategori.querySelectorAll('button.delete');
    const tblKate = kategori.querySelector('table.table');
    const urlHapus = tblKate.getAttribute('data-delete');
    btnDelKate.forEach(function (val) { 
        val.addEventListener('click' , function () { 
            const id = val.getAttribute("data-id");
            Swal.fire({
                title: "Apakah anda yakin ?",
                text: "Data ini akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    const xhr = new XMLHttpRequest();

                    xhr.open("POST", urlHapus);
                    xhr.setRequestHeader(
                        "Content-Type",
                        "application/x-www-form-urlencoded"
                    );
                    xhr.send("id=" + id);
                    xhr.addEventListener("load", function () {
                        if (xhr.status === 200) {
                            const jsonRes = JSON.parse(xhr.response)["msg"];
                            Swal.fire({
                                title: "Kategori",
                                text: jsonRes["text"],
                                icon: jsonRes["icon"],
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                } else {
                                    window.location.reload();
                                }
                            });
                        } else {
                            console.log(xhr.statusText);
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseText,
                                icon: "Warning",
                            });
                        }
                    });
                }
            });
         })
        console.log(val);
     })
}