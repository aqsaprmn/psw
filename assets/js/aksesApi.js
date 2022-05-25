const akses = document.querySelector('div#roleAkses');
const table = akses.querySelector('table#tableRole');
const urlRead = table.getAttribute('data-urlReadData');
const tBody = table.querySelector('tbody');
const roleModal = akses.querySelector('div#roleModal');
const btnTambahRole = roleModal.querySelector('a#tambah');
const btnSimpanRole = roleModal.querySelector('a#simpan');
const titleModal = roleModal.querySelector('.modal-title');
const input = roleModal.querySelector('input');
const btnBatal = roleModal.querySelector('button#tutup');
const btnTambah = akses.querySelector('button#tambah');
const parentInput = input.parentElement;

 // GIVE ACCESS PROCESS

const aksesModal = akses.querySelector('div#aksesModal');
const tableAkses = aksesModal.querySelector('table#tableAkses');
const inputAkses = tableAkses.querySelectorAll('input[type=checkbox]');
const tBodyAkses = tableAkses.querySelector('tbody');
const btnSimpanAkses = aksesModal.querySelector('a#simpan');
readDataRole();

function readDataRole() { 
    const xhr = new XMLHttpRequest;

    xhr.open('POST' , urlRead);
    xhr.send();
    xhr.addEventListener('load' , function() {
        if (xhr.status == 200) {
            let tr = ``;
            let no = 1;
            const jsonRes = JSON.parse(xhr.response)['role'];
            jsonRes.forEach(e => {
                tr += `<tr>
                        <td class="text-center">${no}</td>
                        <td>${e['role_name']}</td>
                        <td style="width:320px;" class="text-center">
                            <button id="akses" data-bs-toggle="modal" data-bs-target="#aksesModal" data-id="${e['id']}" class="btn btn-warning mx-1"><i class="fas fa-code-branch"></i> Akses</button><button id="edit" data-bs-toggle="modal" data-bs-target="#roleModal" data-id="${e['id']}" class="btn btn-primary mx-1"><i class="fas fa-pen"></i> Edit</button><button id="hapus" data-id="${e['id']}" class="btn btn-danger mx-1"><i class="fas fa-trash"></i> Hapus</button>
                        </td>
                     </tr>`;
                
                     no++;
            });
    
            tBody.innerHTML = tr;

            const btnAkses = table.querySelectorAll('button#akses');
            const urlMenuAkses = tableAkses.getAttribute('data-urlMenu');

            for (let i = 0; i < btnAkses.length; i++) {
                const btnAksesI = btnAkses[i];
                
                btnAksesI.addEventListener('click' , function () { 
                    const xhr = new XMLHttpRequest;

                    const roleId = this.getAttribute('data-id');

                    btnSimpanAkses.setAttribute('data-idRole' , roleId);
                    xhr.open('POST' , urlMenuAkses);
                    
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.send('id='+roleId);

                    xhr.addEventListener('load' , function () { 
                        if (xhr.status == 200) {
                            const jsonResMenu = JSON.parse(xhr.response)['menu'];
                            const jsonResAkses = JSON.parse(xhr.response)['akses'];
                            let noAkses = 1;
                            let trAkses = ``;
                            let arrAkses = [];

                            for (let j = 0; j < jsonResAkses.length; j++) {
                                const jsonResAksesJ = jsonResAkses[j];
                                arrAkses.push(jsonResAksesJ['menu_id'])
                            }

                            jsonResMenu.forEach(e => {
                                if (arrAkses.includes(e['id'])) {
                                    trAkses += `<tr>
                                            <td class="text-center">${noAkses}</td>
                                            <td>${e['menu']}</td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="${e['id']}" data-id="${e['id']}" checked>
                                                </div>
                                            </td>
                                        </tr>`;
                                } else {
                                    trAkses += `<tr>
                                            <td class="text-center">${noAkses}</td>
                                            <td>${e['menu']}</td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="${e['id']}" data-id="${e['id']}">
                                                </div>
                                            </td>
                                        </tr>`;
                                }
                                noAkses++;
                            })  
                            
                           tBodyAkses.innerHTML = trAkses;
                        } else {
                            console.log(xhr.response);
                            alert(xhr.response);
                        }
                     })
                 })
            }

                        
            const btnHapus = table.querySelectorAll('button#hapus');
            const urlHapus = table.getAttribute('data-urlHapus');

            for (let i = 0; i < btnHapus.length; i++) {
                const btnHapusI = btnHapus[i];
                
                btnHapusI.addEventListener('click' , function () { 
                    const idRole = this.getAttribute('data-id');
                    
                    const go = confirm('Apa anda yakin ?');
                    const xhr = new XMLHttpRequest;
                    if (go) {
                        xhr.open('POST' , urlHapus);

                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                        xhr.send('id='+idRole);

                        xhr.addEventListener('load' , function () { 
                            if (xhr.status == 200) {
                                const jsonRes = JSON.parse(xhr.response)['msg'];
                                alert(jsonRes['text']);
                                readDataRole();
                            } else {
                                console.log(xhr.response);
                                alert(xhr.response);
                            }
                         })

                    }
                 })
            }

            const btnEdit = table.querySelectorAll('button#edit');
            const urlReadIdRole = table.getAttribute('data-urlReadIdRole');

            for (let i = 0; i < btnEdit.length; i++) {
                const btnEditI = btnEdit[i];
                
                btnEditI.addEventListener('click' , function () { 
                    input.value = "";
                    if (parentInput.querySelector('small')) {
                        parentInput.removeChild(parentInput.querySelector('small'));
                    }
                    submit('');
                    const xhr = new XMLHttpRequest;
                    const idRole = this.getAttribute('data-id');
                    btnSimpanRole.setAttribute('data-id' , idRole);

                    xhr.open('POST' , urlReadIdRole);

                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.send('id='+idRole);

                    xhr.addEventListener('load' , function () { 
                        if (xhr.status == 200) {
                            const jsonRes = JSON.parse(xhr.response)['role'];
                            
                            input.value = jsonRes['role_name'];
                        } else {
                            console.log(xhr.response);
                            alert(xhr.response);
                        }
                    })
                 })
            }
        } else {
            console.log(xhr.response);
            alert(xhr.response);
        }
    })
}

function submit(aksi) {
     if (aksi == 'tambah') {
         btnTambahRole.removeAttribute('hidden');
         btnSimpanRole.setAttribute('hidden','');
         titleModal.innerHTML = 'Tambah Role';
     } else {
        btnSimpanRole.removeAttribute('hidden');
        btnTambahRole.setAttribute('hidden','');
        titleModal.innerHTML = 'Edit Role';
     }
 }

btnTambah.addEventListener('click' , function () { 
    submit('tambah');
    input.value = "";
    if (parentInput.querySelector('small')) {
        parentInput.removeChild(parentInput.querySelector('small'));
    }
 })

 btnSimpanRole.addEventListener('click' , function (e) { 
    e.preventDefault();
    e.stopPropagation();

    const data = 'id='+this.getAttribute('data-id')+'&role_name='+input.value;

    const url = this.href;

    const xhr = new XMLHttpRequest;

    xhr.open('POST' , url);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.send(data);

    xhr.onload = function () { 
        if (xhr.status === 200 ) {
            const jsonRes = JSON.parse(xhr.response)['msg'];
            if (jsonRes['tipe'] == 'input') {
                if (input.name == jsonRes['nama']) {
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
            } else {
                btnBatal.click();
                console.log(jsonRes['text']);
                alert(jsonRes['text']);
                readDataRole();
            }
            
        } else {
            console.log(xhr.statusText);
            alert(xhr.statusText);
        }
    }
})

btnTambahRole.addEventListener('click' , function (e) { 
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();

    const xhr = new XMLHttpRequest;

    xhr.open('POST' , this.href);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send('role_name='+input.value);

    xhr.addEventListener('load' , function () { 
        if (xhr.status == 200) {
            const jsonRes = JSON.parse(xhr.response)['msg'];
            if (jsonRes['tipe'] == 'input') {
                if (input.name == jsonRes['nama']) {
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
            } else {
                btnBatal.click();
                console.log(jsonRes['text']);
                alert(jsonRes['text']);
                readDataRole();
            }
        } else {
            console.log(xhr.response);
            alert(xhr.response);
        }
     })
 })

btnSimpanAkses.addEventListener('click' , function (e) { 
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();

    const role_id = this.getAttribute('data-idRole');
    const xhr = new XMLHttpRequest;
    const inputAkses = tableAkses.querySelectorAll('input');
    const dataMenu = dataPost(inputAkses);
    
    xhr.open('POST' , this.href);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send('role_id='+role_id+'&'+dataMenu);
    
    xhr.addEventListener('load' , function () { 
        if (xhr.status == 200) {
            const jsonRes = JSON.parse(xhr.response)['msg'];
            alert(jsonRes['text'])
            window.location.reload();
        } else {
            console.log(xhr.response);
            alert(xhr.response);
        }
    })
 })

 function dataPost(input) {
    let arrInput = [];
    let data = ``;
    for (let i = 0; i < input.length; i++) {
        const inputI = input[i];
        if (inputI.type == 'checkbox') {
            if (inputI.checked == true) {
                if (i == input.length - 1) {
                    data += inputI.id + "=" + inputI.checked;
                } else {
                    data += inputI.id + "=" + inputI.checked + '&';
                }
                arrInput.push(inputI);
            } else {
                if (i == input.length - 1) {
                    data += inputI.id + "=" + inputI.checked;
                } else {
                    data += inputI.id + "=" + inputI.checked + '&';
                }
                arrInput.push(inputI);
            }
        }
    }
    return data;
}