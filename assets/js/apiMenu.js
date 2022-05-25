// API Menu

// Ttile Menu

// Data Table Title Menu

if (document.querySelector('div#titleMenu')) {
    const divTitleMenu = document.querySelector('div#titleMenu');
    const tableTitleMenu = divTitleMenu.querySelector('table.table');
    const urlAsal = tableTitleMenu.getAttribute('data-url');
    
    // Data Modal
    const modal = divTitleMenu.querySelector('.modal');
    const btnTambah = modal.querySelector('#tambah');
    const btnTambahTitleMenu = divTitleMenu.querySelector('#tambah');
    const modalTitle = modal.querySelector('.modal-title');
    const btnSimpan = modal.querySelector('#simpan');
    const btnBatal = modal.querySelector('#tutup');
    const inputModal = modal.querySelectorAll('input');
    
    // Function Delete
    // const urlHapus = tableTitleMenu.getAttribute('data-urlHapus');
    
    btnTambahTitleMenu.addEventListener('click' , function () { 
        for (let i = 0; i < inputModal.length; i++) {
            const inputModalI = inputModal[i];
            inputModalI.value = "";
    
            const parentInput = inputModalI.parentElement;
    
            if (parentInput.querySelector('small')) {
                const small = parentInput.querySelector('small');
                parentInput.removeChild(small);
            }
        }
    
        submit(this.id , tableTitleMenu , modal , "Tambah Judul Menu" , "Edit Judul Menu");
    })
    
    readDataTitleMenu(tableTitleMenu , modal);
    
    // Add Menu
    // let inputValid = `<small class="text-danger pl-3"></small>`;
    btnTambah.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        const input = modal.querySelectorAll('input');
    
        const data = dataPost(input);
    
        const url = this.href;
    
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(data);
    
        xhr.onload = function () { 
            if (xhr.status === 200 ) {
                const jsonRes = JSON.parse(xhr.response)['msg'];
                loadCU(jsonRes , modal , urlAsal);
            } else {
                console.log(xhr.statusText);
                alert(xhr.statusText);
            }
        }
    })
    
    btnSimpan.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        const input = modal.querySelectorAll('input');
        const idMenu = this.getAttribute('data-id');
    
        const data = dataPost(input) + '&id=' + idMenu;
    
        const url = this.href;
    
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(data);
    
        xhr.onload = function () { 
            if (xhr.status === 200 ) {
                const jsonRes = JSON.parse(xhr.response)['msg'];
                loadCU(jsonRes , modal , urlAsal);
            } else {
                console.log(xhr.statusText);
                alert(xhr.statusText);
            }
        }
    })
    
}
// Menu

// Read Menu Function

// Data Table Menu
else if (document.querySelector('div#menuGo')) {
    const divMenu = document.querySelector('div#menuGo');
    const tableMenu = divMenu.querySelector('table.table');
    const urlAsal = tableMenu.getAttribute('data-url');
    
    // Data Modal
    const modal = divMenu.querySelector('.modal');
    const btnTambah = modal.querySelector('#tambah');
    const btnTambahTitleMenu = divMenu.querySelector('#tambah');
    // const modalTitle = modal.querySelector('.modal-title');
    const btnSimpan = modal.querySelector('#simpan');
    // const btnBatal = modal.querySelector('#tutup');
    const inputModal = modal.querySelectorAll('input');

    // Function Delete  
    // const urlHapus = tableTitleMenu.getAttribute('data-urlHapus');
    
    btnTambahTitleMenu.addEventListener('click' , function () { 
        for (let i = 0; i < inputModal.length; i++) {
            const inputModalI = inputModal[i];
            inputModalI.value = "";
    
            const parentInput = inputModalI.parentElement;
    
            if (parentInput.querySelector('small')) {
                const small = parentInput.querySelector('small');
                parentInput.removeChild(small);
            }
        }
    
        submit(this.id , tableMenu , modal , "Tambah Menu" , "Edit Menu");
    })
    
    readDataMenuGo(tableMenu , modal);

    

    // Add Menu
    // let inputValid = `<small class="text-danger pl-3"></small>`;
    btnTambah.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        const input = modal.querySelectorAll('input');
        const select = modal.querySelectorAll('select');
    
        const data = dataPost(input) + "&" + dataPost(select);
    
        const url = this.href;
    
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(data);
    
        xhr.onload = function () { 
            if (xhr.status === 200 ) {
                const jsonRes = JSON.parse(xhr.response)['msg'];
                loadCU(jsonRes , modal , urlAsal);
            } else {
                console.log(xhr.statusText);
                alert(xhr.statusText);
            }
        }
    })
    
    btnSimpan.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        const input = modal.querySelectorAll('input');
        const idMenu = this.getAttribute('data-id');
        const select = modal.querySelectorAll('select');
    
        const data = dataPost(input) + '&' + dataPost(select) + '&id=' + idMenu;
    
        const url = this.href;
    
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(data);
    
        xhr.onload = function () { 
            if (xhr.status === 200 ) {
                const jsonRes = JSON.parse(xhr.response)['msg'];
                loadCU(jsonRes , modal , urlAsal);
            } else {
                console.log(xhr.statusText);
                alert(xhr.statusText);
            }
        }
    })
}
// Sub Menu

// Read Sub Menu Function

// Data Table Sub Menu
else {
    const divSubMenu = document.querySelector('div#subMenuGo');
    const tableSubMenu = divSubMenu.querySelector('table.table');
    const urlAsal = tableSubMenu.getAttribute('data-url');
    
    // Data Modal
    const modal = divSubMenu.querySelector('.modal');
    const btnTambah = modal.querySelector('#tambah');
    const btnTambahTitleMenu = divSubMenu.querySelector('#tambah');
    // const modalTitle = modal.querySelector('.modal-title');
    const btnSimpan = modal.querySelector('#simpan');
    // const btnBatal = modal.querySelector('#tutup');
    const inputModal = modal.querySelectorAll('input');

    // Function Delete  
    // const urlHapus = tableTitleMenu.getAttribute('data-urlHapus');
    
    btnTambahTitleMenu.addEventListener('click' , function () { 
        for (let i = 0; i < inputModal.length; i++) {
            const inputModalI = inputModal[i];
            inputModalI.value = "";
    
            const parentInput = inputModalI.parentElement;
    
            if (parentInput.querySelector('small')) {
                const small = parentInput.querySelector('small');
                parentInput.removeChild(small);
            }
        }
    
        submit(this.id , tableSubMenu , modal , "Tambah Menu" , "Edit Menu");
    })
    
    readDataSubMenuGo(tableSubMenu , modal);

    

    // Add Menu
    // let inputValid = `<small class="text-danger pl-3"></small>`;
    btnTambah.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        const input = modal.querySelectorAll('input');
        const select = modal.querySelectorAll('select');
    
        const data = dataPost(input) + "&" + dataPost(select);
    
        const url = this.href;
    
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(data);
    
        xhr.onload = function () { 
            if (xhr.status === 200 ) {
                const jsonRes = JSON.parse(xhr.response)['msg'];
                loadCU(jsonRes , modal , urlAsal);
            } else {
                console.log(xhr.statusText);
                alert(xhr.statusText);
            }
        }
    })
    
    btnSimpan.addEventListener('click' , function (e) { 
        e.preventDefault();
        e.stopPropagation();
    
        const input = modal.querySelectorAll('input');
        const idMenu = this.getAttribute('data-id');
        const select = modal.querySelectorAll('select');

        const data = dataPost(input) + '&' + dataPost(select) + '&id=' + idMenu;
    
        const url = this.href;
    
        const xhr = new XMLHttpRequest;
    
        xhr.open('POST' , url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(data);
    
        xhr.onload = function () { 
            if (xhr.status === 200 ) {
                const jsonRes = JSON.parse(xhr.response)['msg'];
                // console.log(jsonRes);
                loadCU(jsonRes , modal , urlAsal);
            } else {
                console.log(xhr.statusText);
                alert(xhr.statusText);
            }
        }
    })
}

// Function hapus validasi small
function deleteValidasiInput(input) {
    for (let i = 0; i < input.length; i++) {
        const inputModalI = input[i];
        const parentInput = inputModalI.parentElement;

        if (parentInput.querySelector('small')) {
            const small = parentInput.querySelector('small');
            parentInput.removeChild(small);
        }
    }
}

// Read Title Menu Function
function readDataTitleMenu(table , modal) { 
    let no = 1;
    let trMenuTitle = ``;
    const tBody = table.querySelector('tbody');
    const url = table.getAttribute('data-urlRead');
    const xhr = new XMLHttpRequest;
    const btnSimpan = modal.querySelector('#simpan');
    const inputModal = modal.querySelectorAll('input');
    const urlHapus = table.getAttribute('data-urlHapus');
    const urlAsal = table.getAttribute('data-url');

    xhr.open('POST' , url);
    xhr.send();

    xhr.onload = function () { 
        if (xhr.status === 200 ) {
            const jsonRes = JSON.parse(xhr.response)['menu'];
            jsonRes.forEach(e => {
                trMenuTitle += `<tr class="p-0">
                                    <td class="text-center" scope="row">${no}</td>
                                    <td>${e['menu']}</td>
                                    <td style="width: 200px;" class="text-center"><button id="edit" data-id="${e['id']}" class="btn btn-primary mr-1" data-bs-toggle="modal" data-bs-target="#judulMenuModal">Edit</button><button id="hapus" data-id="${e['id']}" class="btn btn-danger">Hapus</button></td>
                                </tr>`; 
                no++;
            });

            tBody.innerHTML = trMenuTitle;
            const BtnHapus = table.querySelectorAll('#hapus');
            const BtnEdit = table.querySelectorAll('#edit');

            for (let i = 0; i < BtnHapus.length; i++) {
                const BtnHapusI = BtnHapus[i];

                BtnHapusI.addEventListener('click' , function () {
                    const idData = BtnHapusI.getAttribute('data-id');
                    hapusData(idData , urlHapus , urlAsal);
                 })
            }

            for (let i = 0; i < BtnEdit.length; i++) {
                const BtnEditI = BtnEdit[i];

                BtnEditI.addEventListener('click' , function () {
                    for (let i = 0; i < inputModal.length; i++) {
                        const inputModalI = inputModal[i];
                        inputModalI.value = "";

                        const parentInput = inputModalI.parentElement;

                        if (parentInput.querySelector('small')) {
                            const small = parentInput.querySelector('small');
                            parentInput.removeChild(small);
                        }
                    }
                    btnSimpan.setAttribute('data-id' , this.getAttribute('data-id'));
                    submit(this.getAttribute('data-id') , table , modal , "Tambah Judul Menu" , "Edit Judul Menu");
                 })
            }
        } else {
            console.log(xhr.statusText);
            alert(xhr.statusText);
        }
     }
 }

 //Function Read Data Menu
 function readDataMenuGo(table , modal) { 
    let no = 1;
    let trMenuTitle = ``;
    const tBody = table.querySelector('tbody');
    const url = table.getAttribute('data-urlRead');
    const xhr = new XMLHttpRequest;
    const btnSimpan = modal.querySelector('#simpan');
    const inputModal = modal.querySelectorAll('input');
    const urlHapus = table.getAttribute('data-urlHapus');
    const urlAsal = table.getAttribute('data-url');

    xhr.open('POST' , url);
    xhr.send();

    xhr.onload = function () { 
        if (xhr.status === 200 ) {
            const jsonRes = JSON.parse(xhr.response)['menu'];
            jsonRes.forEach(e => {
                (e['is_active'] == 1) ? e['is_active'] = "Y" : e['is_active'] = "N";

                (e['sub_menu_active'] == 1) ? e['sub_menu_active'] = "Y" : e['sub_menu_active'] = "N";

                (e['url'] == null) ? e['url'] = "" : e['url'];

                trMenuTitle += `<tr class="p-0">
                                    <td class="text-center" scope="row">${no}</td>
                                    <td scope="row">${e['menu']}</td>
                                    <td scope="row">${e['title']}</td>
                                    <td scope="row">${e['url']}</td>
                                    <td scope="row">${e['icon']}</td>
                                    <td class="text-center" scope="row">${e['is_active']}</td>
                                    <td class="text-center" scope="row">${e['sub_menu_active']}</td>
                                    <td style="width: 200px;" class="text-center"><button id="edit" data-id="${e['id_menu_go']}" class="btn btn-primary mr-1" data-bs-toggle="modal" data-bs-target="#judulMenuModal">Edit</button><button id="hapus" data-id="${e['id_menu_go']}" class="btn btn-danger">Hapus</button></td>
                                </tr>`; 
                no++;
            });

            tBody.innerHTML = trMenuTitle;
            const BtnHapus = table.querySelectorAll('#hapus');
            const BtnEdit = table.querySelectorAll('#edit');

            for (let i = 0; i < BtnHapus.length; i++) {
                const BtnHapusI = BtnHapus[i];

                BtnHapusI.addEventListener('click' , function () {
                    const idData = BtnHapusI.getAttribute('data-id');
                    hapusData(idData , urlHapus , urlAsal);
                 })
            }

            for (let i = 0; i < BtnEdit.length; i++) {
                const BtnEditI = BtnEdit[i];

                BtnEditI.addEventListener('click' , function () {
                    for (let i = 0; i < inputModal.length; i++) {
                        const inputModalI = inputModal[i];
                        inputModalI.value = "";

                        const parentInput = inputModalI.parentElement;

                        if (parentInput.querySelector('small')) {
                            const small = parentInput.querySelector('small');
                            parentInput.removeChild(small);
                        }
                    }
                    btnSimpan.setAttribute('data-id' , this.getAttribute('data-id'));
                    submit(this.getAttribute('data-id') , table , modal , "Tambah Menu" , "Edit Menu");
                 })
            }
        } else {
            console.log(xhr.statusText);
            alert(xhr.statusText);
        }
     }
 }

 //Function Read Data Menu
 function readDataSubMenuGo(table , modal) { 
    let no = 1;
    let trMenuTitle = ``;
    const tBody = table.querySelector('tbody');
    const url = table.getAttribute('data-urlRead');
    const xhr = new XMLHttpRequest;
    const btnSimpan = modal.querySelector('#simpan');
    const inputModal = modal.querySelectorAll('input');
    const urlHapus = table.getAttribute('data-urlHapus');
    const urlAsal = table.getAttribute('data-url');

    xhr.open('POST' , url);
    xhr.send();

    xhr.onload = function () { 
        if (xhr.status === 200 ) {
            const jsonRes = JSON.parse(xhr.response)['menu'];
            jsonRes.forEach(e => {
                (e['is_active'] == 1) ? e['is_active'] = "Y" : e['is_active'] = "N";

                (e['title_menu'] == null) ? e['title_menu'] = "" : e['title_menu'];

                trMenuTitle += `<tr class="p-0">
                                    <td class="text-center" scope="row">${no}</td>
                                    <td scope="row">${e['title_menu']}</td>
                                    <td scope="row">${e['title_sub_menu']}</td>
                                    <td scope="row">${e['url']}</td>
                                    <td scope="row">${e['icon']}</td>
                                    <td class="text-center" scope="row">${e['is_active']}</td>
                                    <td style="width: 200px;" class="text-center"><button id="edit" data-id="${e['id_sub_menu_go']}" class="btn btn-primary mr-1" data-bs-toggle="modal" data-bs-target="#subMenuModal">Edit</button><button id="hapus" data-id="${e['id_sub_menu_go']}" class="btn btn-danger">Hapus</button></td>
                                </tr>`;
                no++;
            });

            tBody.innerHTML = trMenuTitle;
            const BtnHapus = table.querySelectorAll('#hapus');
            const BtnEdit = table.querySelectorAll('#edit');

            for (let i = 0; i < BtnHapus.length; i++) {
                const BtnHapusI = BtnHapus[i];

                BtnHapusI.addEventListener('click' , function () {
                    const idData = BtnHapusI.getAttribute('data-id');
                    hapusData(idData , urlHapus , urlAsal);
                 })
            }

            for (let i = 0; i < BtnEdit.length; i++) {
                const BtnEditI = BtnEdit[i];

                BtnEditI.addEventListener('click' , function () {
                    for (let i = 0; i < inputModal.length; i++) {
                        const inputModalI = inputModal[i];
                        inputModalI.value = "";
                
                        const parentInput = inputModalI.parentElement;
                
                        if (parentInput.querySelector('small')) {
                            const small = parentInput.querySelector('small');
                            parentInput.removeChild(small);
                        }
                    }
            
                    btnSimpan.setAttribute('data-id' , this.getAttribute('data-id'));
                    submit(this.getAttribute('data-id') , table , modal , "Tambah Sub Menu" , "Edit Sub Menu");
                 })
            }
        } else {
            console.log(xhr.statusText);
            alert(xhr.statusText);
        }
     }
 }

// Function Kumpulin data for send Post Ajax 
function dataPost(input) {
    let arrInput = [];
    let data = ``;
    for (let i = 0; i < input.length; i++) {
        const inputI = input[i];
        if (inputI.type == 'checkbox') {
            if (inputI.checked == true) {
                if (i == input.length - 1) {
                    data += inputI.id + "=on";
                } else {
                    data += inputI.id + "=on&";
                }
                arrInput.push(inputI);
            } else {
                if (i == input.length - 1) {
                    data += inputI.id + "=off";
                } else {
                    data += inputI.id + "=off&";
                }
                arrInput.push(inputI);
            }
        } else {
            if (i == input.length - 1) {
                data += inputI.id + "=" + inputI.value;
            } else {
                data += inputI.id + "=" + inputI.value + "&";
            }
            arrInput.push(inputI);
        }
    }
    return data;
}

// Function Load Ajax After Tambah dan Simpan
function loadCU(jsonRes , modal , urlAsal) {
    const btnBatal = modal.querySelector('#tutup');
    const input = modal.querySelectorAll('input');
    if (jsonRes['tipe'] == 'input') {
        for (let j = 0; j < input.length; j++) {
            const inputJ = input[j];
            const parentInput = inputJ.parentElement;
            if (inputJ.id == jsonRes['nama']) {
                if (parentInput.querySelector('small')) {
                    parentInput.removeChild(parentInput.querySelector('small'));
                } 
                const small = document.createElement('small');
                const text = jsonRes['text'];
                small.classList.add('text-danger');
                small.classList.add('pl-2');
                small.append(text);
                parentInput.append(small);
            } else {
                if (parentInput.querySelector('small')) {
                    parentInput.removeChild(parentInput.querySelector('small'));
                }
            }
        }
    } else {
        // let condBtnBatal = false;

        // btnBatal.addEventListener('click' , function () { 
        //     condBtnBatal = true;
        // })

        btnBatal.click();
        
        for (let i = 0; i < input.length; i++) {
            const inputI = input[i];
            inputI.value = "";
        }
        
        Swal.fire({
            title : 'Menu',
            text : jsonRes['text'],
            icon : 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = urlAsal;
              }
            else {
                document.location.href = urlAsal;
              }
        });
    }
}

function hapusData(id , urlHapus , urlAsal) { 
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
            xhr.send('id='+id);
            xhr.addEventListener('load' , function () { 
                if (xhr.status === 200 ) {
                    const jsonRes = JSON.parse(xhr.response)['msg'];
                    Swal.fire({
                        title : 'Menu',
                        text : jsonRes['text'],
                        icon : 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href = urlAsal;
                          }
                        else {
                            document.location.href = urlAsal;
                          }
                    });
                } else {
                    console.log(xhr.statusText);
                    alert(xhr.statusText);
                }
            })
        }
      })
 }

// Function merubah title dan button modal
 function submit(aksi , table , modal , modalTitleTambah , modalTitleEdit) {
    const btnTambah = modal.querySelector('#tambah');
    const btnSimpan = modal.querySelector('#simpan');
    const modalTitle = modal.querySelector('.modal-title');

     if (aksi == 'tambah') {
         btnTambah.removeAttribute('hidden');
         btnSimpan.setAttribute('hidden','');
         modalTitle.innerHTML = modalTitleTambah;
     } else {
        btnSimpan.removeAttribute('hidden');
        btnTambah.setAttribute('hidden','');
        modalTitle.innerHTML = modalTitleEdit;

        dataMenuId(aksi,table.getAttribute('data-urlIdMenu'),modalTitle);
     }
 }

 // Function Tarik Data Menu Id Edit
 function dataMenuId(id , url , modalTitle) { 

    const parentModal = modalTitle.parentElement.parentElement;

    const parentId = parentModal.id;
     
    const inputModal = parentModal.querySelectorAll('input');

    const xhr = new XMLHttpRequest;
    xhr.open('POST' , url);
    xhr.setRequestHeader('Content-Type' , "application/x-www-form-urlencoded");
    xhr.send('id='+id);
    xhr.addEventListener('load' , function () { 
        if (xhr.status === 200 ) {
            const jsonPar = JSON.parse(xhr.responseText)['menu'];
            const objKeyRes = (Object.keys(jsonPar));
            if (parentId == "titleMenuModal") {
                for (let i = 0; i < inputModal.length; i++) {
                    const inputModalI = inputModal[i];
                    
                    for (let j = 0; j < objKeyRes.length; j++) {
                        const objKeyResJ = objKeyRes[j];
                        if (objKeyResJ == inputModalI.name) {
                            inputModalI.value = jsonPar[objKeyResJ];
                        }
                    }
                }
            } else if (parentId == "menuGoModal" || parentId == "subMenuGoModal") {
                const select = parentModal.querySelector('select');

                const option = select.querySelectorAll('option');
                
                for (let j = 0; j < option.length; j++) {
                    const optionJ = option[j];
                    
                    if (optionJ.value == jsonPar['menu_id'] || optionJ.value == jsonPar['menu_go_id']) {
                        optionJ.setAttribute('selected' , '');
                    } else {
                        optionJ.removeAttribute('selected');
                    }
                }
                
                for (let i = 0; i < inputModal.length; i++) {
                    const inputModalI = inputModal[i];    
                    for (let j = 0; j < objKeyRes.length; j++) {
                        const objKeyResJ = objKeyRes[j];
                        if (objKeyResJ == inputModalI.name) {
                            if (inputModalI.className == 'form-check-input') {
                                if (jsonPar[inputModalI.name] == 1 ) {
                                    inputModalI.setAttribute('checked' , '');
                                } else {
                                    inputModalI.removeAttribute('checked');
                                }
                            } else {
                                inputModalI.value = jsonPar[objKeyResJ];
                            }
                        }
                    }
                }
            }
            
        } else {
            console.log(xhr.statusText);
            alert(xhr.statusText);
        }
    })
}