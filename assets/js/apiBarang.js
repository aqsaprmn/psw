const divHilang = document.getElementById('barangHilang');
let no =  1;
if (divHilang) {
    const tblHilang = divHilang.querySelector('table.table');
    const tblTbody = tblHilang.querySelector('tBody');
    const urlAll = tblHilang.getAttribute('data-all');
    const urlHapus = tblHilang.getAttribute('data-hapus');
    const urlEdit = tblHilang.getAttribute('data-edit');
    
    readBarangHilang()

    function readBarangHilang() { 
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , urlAll);
        xhr.send();
        xhr.addEventListener('load' , function()  {
            if (xhr.status == 200) {
                const jsonRes = JSON.parse(xhr.response)['barangHilang'];
                let trHilang = ``;
                for (let i = 0; i < jsonRes.length; i++) {
                    const jsonResI = jsonRes[i];
                    trHilang += `
                    <tr>
                        <td class="text-center">${no}</td>
                        <td>${jsonResI['nama_barang']}</td>
                        <td>${jsonResI['kategori']}</td>
                        <td class="text-center">${jsonResI['tanggal_hilang']}</td>
                        <td class="text-center ${(jsonResI['status'] === 'Y') ? "text-danger" : "text-succsess"}">${(jsonResI['status'] === 'Y') ? "Barang Belum Kembali" : "Barang Sudah Kembali"}</td>
                        <td class="text-center" style="width:240px"><button class="btn btn-primary">Detail</button><a class="btn btn-warning mx-1" href="${urlEdit}/${jsonResI['kode']}">Edit</a><button data-id="${jsonResI['kode']}" class="btn btn-danger delete">Delete</button></td>
                    </tr>
                        
                    `;
    
                    no++;
                }
                tblTbody.innerHTML = trHilang;
    
                const btnDel = tblHilang.querySelectorAll('button.delete');
                btnDel.forEach((val , key) => {
                    val.addEventListener('click' , function() {
                        const kode = val.getAttribute('data-id');
                        Swal.fire({
                            title: 'Apakah anda yakin ?',
                            text: "Data ini akan dihapus!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const xhr = new XMLHttpRequest;
                                
                                xhr.open('POST' , urlHapus);
                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                xhr.send('kode='+kode);
                                xhr.addEventListener('load' , function () { 
                                    if (xhr.status === 200 ) {
                                        const jsonRes = JSON.parse(xhr.response)['msg'];
                                        Swal.fire({
                                            title : 'Barang Hilang',
                                            text : jsonRes['text'],
                                            icon : jsonRes['icon']
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                readBarangHilang();
                                            }
                                            else {
                                                readBarangHilang();
                                            }
                                        });
                                    } else {
                                        console.log(xhr.statusText);
                                        Swal.fire({
                                            title : 'Error',
                                            text : xhr.responseText,
                                            icon : 'Warning'
                                        })
                                    }
                                })
                            }
                        })
                    })
                })
            
            } else {
                console.log(xhr.statusText);
                Swal.fire({
                    title : 'Error',
                    text : xhr.statusText,
                    icon : 'Warning'
                });
            }
        })
    }
}

