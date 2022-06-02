const divHilang = document.getElementById("barangHilang");
const divTemuan = document.getElementById("barangTemuan");

if (divHilang) {
	const tblHilang = divHilang.querySelector("table.table");
	const tblTbody = tblHilang.querySelector("tBody");
	const urlAll = tblHilang.getAttribute("data-all");
	const urlHapus = tblHilang.getAttribute("data-hapus");
	const urlEdit = tblHilang.getAttribute("data-edit");
	const keyword = divHilang.querySelector('#keyword');	

	readBarangHilang();

	function readBarangHilang(keyword = "") {
		const xhr = new XMLHttpRequest();
		let no = 1;

		xhr.open("POST", urlAll);

		if (keyword != "") {
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("keyword="+keyword);
		} else {
			xhr.send();
		}
		
		xhr.addEventListener("load", function () {
			if (xhr.status == 200) {
				const jsonRes = JSON.parse(xhr.response)["barangHilang"];
				let trHilang = ``;
				for (let i = 0; i < jsonRes.length; i++) {
					const jsonResI = jsonRes[i];
					trHilang += `
                    <tr>
                        <td class="text-center">${no}</td>
                        <td>${jsonResI["nama_barang"]}</td>
                        <td>${jsonResI["kategori"]}</td>
                        <td class="text-center">${
													jsonResI["tanggal_hilang"]
												}</td>
                        <td class="text-center ${
													jsonResI["status"] === "Y"
														? "text-danger"
														: jsonResI["status"] === "N"
														? "text-success"
														: "text-warning"
												}">${
						jsonResI["status"] === "Y"
							? "Barang Belum Kembali"
							: jsonResI["status"] === "N"
							? "Barang Sudah Kembali"
							: "Barang Sedang Diproses"
					}</td>
                        <td class="text-center" style="width:240px"><button data-kd="${jsonResI['kode']}" class="detail btn btn-primary">Detail</button><a class="btn btn-warning mx-1" href="${urlEdit}/${
						jsonResI["kode"]
					}">Edit</a><button data-id="${
						jsonResI["kode"]
					}" class="btn btn-danger delete">Delete</button></td>
                    </tr>
					<tr style="" class="d-none collapseTable" data-kd="${jsonResI['kode']}">
						<td colspan="6" style="">
							<div style="height:200px" class="row overflow-auto">
								<div class="col-sm-6">
									<div class="row text-center mb-2">
										<span class=""><b>Data Barang</b></span>
									</div>
									<table style="" class="table text-black">
									<tr>
									<th class="">Kode Barang</th>
									<td>${jsonResI['kode']}</td>
									</tr>
									<tr>
									<th class="text-bold">Nama Barang</th>
									<td>${jsonResI['nama_barang']}</td>
									</tr>
									<tr>
									<th class="">Kategori</th>
									<td>${jsonResI['kategori']}</td>
									</tr>
									<tr>
									<th class="">Tanggal Hilang</th>
									<td>${jsonResI['tanggal_hilang']}</td>
									</tr>
									<tr>
									<th class="">Gambar 1</th>
									<td><img style="width:240px" src="../assets/baranghilang/${jsonResI['gambar1']}" alt="${jsonResI['gambar1']}"></td>
									</tr>
									<tr>
									<th class="">Gambar 1</th>
									<td><img style="width:240px" src="../assets/baranghilang/${jsonResI['gambar2']}" alt="${jsonResI['gambar2']}"></td>
									</tr>
									<tr>
									<th class="">Status</th>
									<td class="${
										jsonResI["status"] === "Y"
											? "text-danger"
											: jsonResI["status"] === "N"
											? "text-success"
											: "text-warning"
									}">${
										jsonResI["status"] === "Y"
											? "Barang Belum Kembali"
											: jsonResI["status"] === "N"
											? "Barang Sudah Kembali"
											: "Barang Sedang Diproses"
									}</td>
									</table>
								</div>
								<div class="col-sm-6">
									<div class="row text-center mb-2">
									<span class=""><b>Data Pemilik</b></span>
									</div>
									<table class="table text-black">
									<tr>
									<th class="">Nama </th>
									<td>${jsonResI['nama_pemilik']}</td>
									</tr>
									<tr>
									<th class="">Alamat</th>
									<td>${jsonResI['alamat']}</td>
									</tr>
									<tr>
									<th class="">Telpon</th>
									<td><a target="_blank" href="https://wa.me/${jsonResI['no_telp']}?text=Hallo%20${jsonResI['nama_pemilik']}%20Saya%20Menemukan%20Barangmu%20yang%20hilang...">${jsonResI['no_telp']}</a></td>
									</tr>
									<tr>
									<th class="">Email</th>
									<td><a target="_blank" href="mailto:${jsonResI['email']}">${jsonResI['email']}</a></td>
									</tr>
									<tr>
									<th class="">Foto Pemilik</th>
									<td><img style="width:240px" src="../assets/image/${jsonResI['gambar']}" alt="${jsonResI['gambar']}"></td>
									</tr>
									</table>
								</div>
							</div>
						</td>
					</tr>
					`;

					no++;
				}
				tblTbody.innerHTML = trHilang;

				const btnDel = tblHilang.querySelectorAll("button.delete");
				btnDel.forEach((val, key) => {
					val.addEventListener("click", function () {
						const kode = val.getAttribute("data-id");
						deleteBarang(kode , urlHapus , "Barang Hilang" , 'hilang');
					});
				});

				const btnDetail = tblHilang.querySelectorAll("button.detail");
				const trDetail = tblHilang.querySelectorAll("tr.collapseTable");
				btnDetail.forEach(function (valbtn) { 
					valbtn.addEventListener('click' , function () { 
						const btndatakd = valbtn.getAttribute('data-kd');

						trDetail.forEach(function (valtr) { 
							const trdatakd = valtr.getAttribute('data-kd');

							if (trdatakd == btndatakd) {
								valtr.classList.toggle('d-none');
							} else {
								valtr.classList.add('d-none');
							}
						 })
					 })
				 })
			} else {
				console.log(xhr.statusText);
				Swal.fire({
					title: "Error",
					text: xhr.statusText,
					icon: "Warning",
				});
			}
		});
	}

	keyword.addEventListener('input' , function () { 
		readBarangHilang(keyword.value);
	 });
}
else if (divTemuan) {
	const tblTemuan = divTemuan.querySelector("table.table");
	const tblTbody = tblTemuan.querySelector("tBody");
	const urlAll = tblTemuan.getAttribute("data-all");
	const urlHapus = tblTemuan.getAttribute("data-hapus");
	const urlEdit = tblTemuan.getAttribute("data-edit");
	const keyword = divTemuan.querySelector('#keyword');	

	readBarangTemuan();

	function readBarangTemuan(keyword = "") {
		const xhr = new XMLHttpRequest();
		let no = 1;

		xhr.open("POST", urlAll);

		if (keyword != "") {
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("keyword="+keyword);
		} else {
			xhr.send();
		}
		
		xhr.addEventListener("load", function () {
			if (xhr.status == 200) {
				const jsonRes = JSON.parse(xhr.response)["barangTemuan"];
				let trTemuan = ``;
				for (let i = 0; i < jsonRes.length; i++) {
					const jsonResI = jsonRes[i];
					trTemuan += `
                    <tr>
                        <td class="text-center">${no}</td>
                        <td>${jsonResI["nama_barang"]}</td>
                        <td>${jsonResI["kategori"]}</td>
                        <td class="text-center">${
													jsonResI["tanggal_temuan"]
												}</td>
                        <td class="text-center ${
													jsonResI["status"] === "Y"
														? "text-danger"
														: jsonResI["status"] === "N"
														? "text-success"
														: "text-warning"
												}">${
						jsonResI["status"] === "Y"
							? "Barang Belum Kembali"
							: jsonResI["status"] === "N"
							? "Barang Sudah Kembali"
							: "Barang Sedang Diproses"
					}</td>
                        <td class="text-center" style="width:240px"><button data-kd="${jsonResI['kode']}" class="detail btn btn-primary">Detail</button><a class="btn btn-warning mx-1" href="${urlEdit}/${
						jsonResI["kode"]
					}">Edit</a><button data-id="${
						jsonResI["kode"]
					}" class="btn btn-danger delete">Delete</button></td>
                    </tr>
					<tr style="" class="d-none collapseTable" data-kd="${jsonResI['kode']}">
						<td colspan="6" style="">
							<div style="height:200px" class="row overflow-auto">
								<div class="col-sm-6">
									<div class="row text-center mb-2">
										<span class=""><b>Data Barang</b></span>
									</div>
									<table style="" class="table text-black">
									<tr>
									<th class="">Kode Barang</th>
									<td>${jsonResI['kode']}</td>
									</tr>
									<tr>
									<th class="text-bold">Nama Barang</th>
									<td>${jsonResI['nama_barang']}</td>
									</tr>
									<tr>
									<th class="">Kategori</th>
									<td>${jsonResI['kategori']}</td>
									</tr>
									<tr>
									<th class="">Tanggal Temuan</th>
									<td>${jsonResI['tanggal_temuan']}</td>
									</tr>
									<tr>
									<th class="">Gambar 1</th>
									<td><img style="width:240px" src="../assets/barangtemu/${jsonResI['gambar1']}" alt="${jsonResI['gambar1']}"></td>
									</tr>
									<tr>
									<th class="">Gambar 1</th>
									<td><img style="width:240px" src="../assets/barangtemu/${jsonResI['gambar2']}" alt="${jsonResI['gambar2']}"></td>
									</tr>
									<tr>
									<th class="">Status</th>
									<td class="${
										jsonResI["status"] === "Y"
											? "text-danger"
											: jsonResI["status"] === "N"
											? "text-success"
											: "text-warning"
									}">${
										jsonResI["status"] === "Y"
											? "Barang Belum Kembali"
											: jsonResI["status"] === "N"
											? "Barang Sudah Kembali"
											: "Barang Sedang Diproses"
									}</td>
									</table>
								</div>
								<div class="col-sm-6">
									<div class="row text-center mb-2">
									<span class=""><b>Data Pemilik</b></span>
									</div>
									<table class="table text-black">
									<tr>
									<th class="">Nama </th>
									<td>${jsonResI['nama_pemilik']}</td>
									</tr>
									<tr>
									<th class="">Alamat</th>
									<td>${jsonResI['alamat']}</td>
									</tr>
									<tr>
									<th class="">Telpon</th>
									<td><a target="_blank" href="https://wa.me/${jsonResI['no_telp']}?text=Hallo%20${jsonResI['nama_pemilik']}%20Saya%20Menemukan%20Barangmu%20yang%20hilang...">${jsonResI['no_telp']}</a></td>
									</tr>
									<tr>
									<th class="">Email</th>
									<td><a target="_blank" href="mailto:${jsonResI['email']}">${jsonResI['email']}</a></td>
									</tr>
									<tr>
									<th class="">Foto Pemilik</th>
									<td><img style="width:240px" src="../assets/image/${jsonResI['gambar']}" alt="${jsonResI['gambar']}"></td>
									</tr>
									</table>
								</div>
							</div>
						</td>
					</tr>
					`;

					no++;
				}
				tblTbody.innerHTML = trTemuan;

				const btnDel = tblTemuan.querySelectorAll("button.delete");
				btnDel.forEach((val, key) => {
					val.addEventListener("click", function () {
						const kode = val.getAttribute("data-id");
						deleteBarang(kode , urlHapus , "Barang Temuan" , 'temuan');
					});
				});

				const btnDetail = tblTemuan.querySelectorAll("button.detail");
				const trDetail = tblTemuan.querySelectorAll("tr.collapseTable");
				btnDetail.forEach(function (valbtn) { 
					valbtn.addEventListener('click' , function () { 
						const btndatakd = valbtn.getAttribute('data-kd');

						trDetail.forEach(function (valtr) { 
							const trdatakd = valtr.getAttribute('data-kd');

							if (trdatakd == btndatakd) {
								valtr.classList.toggle('d-none');
							} else {
								valtr.classList.add('d-none');
							}
						 })
					 })
				 })
			} else {
				console.log(xhr.statusText);
				Swal.fire({
					title: "Error",
					text: xhr.statusText,
					icon: "Warning",
				});
			}
		});
	}

	keyword.addEventListener('input' , function () { 
		readBarangTemuan(keyword.value);
	 });
}

function deleteBarang(kode , url , title , redirect) { 
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

			xhr.open("POST", url);
			xhr.setRequestHeader(
				"Content-Type",
				"application/x-www-form-urlencoded"
			);
			xhr.send("kode=" + kode);
			xhr.addEventListener("load", function () {
				if (xhr.status === 200) {
					const jsonRes = JSON.parse(xhr.response)["msg"];
					Swal.fire({
						title: title,
						text: jsonRes["text"],
						icon: jsonRes["icon"],
					}).then((result) => {
						if (result.isConfirmed) {
							redirect == 'hilang' ? readBarangHilang() : readBarangTemuan();
						} else {
							redirect == 'hilang' ? readBarangHilang() : readBarangTemuan();
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
}