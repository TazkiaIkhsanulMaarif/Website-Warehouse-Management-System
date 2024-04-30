// Menambahkan event listener pada tombol "Tambah Input"
var addFormBtn = document.getElementById("addFormBtn");
addFormBtn.addEventListener("click", addFormWithSeparator);

// Fungsi untuk menambahkan input ke dalam div baru
function addFormWithSeparator() {
  // Mendapatkan nilai dari setiap input
  var namaBarang = document.getElementById("namaBarang").value;
  var gambar = document.getElementById("gambar").value;
  var kategori = document.getElementById("kategori").value;
  var otherKategori = document.getElementById("otherKategoriInput").value;
  var ukuran = document.getElementById("ukuran").value;
  var harga = document.getElementById("harga").value;
  var satuan = document.getElementById("satuan").value;

  // Membuat elemen div baru sebagai wadah untuk input yang ditambahkan
  var inputDiv = document.createElement("div");
  inputDiv.classList.add("form-group");

  // Membuat elemen hr sebagai pemisah
  var hr = document.createElement("hr");

  // Membuat elemen label dan input untuk setiap nilai input
  var labelNamaBarang = document.createElement("label");
  labelNamaBarang.textContent = "Nama Barang";
  var inputNamaBarang = document.createElement("input");
  inputNamaBarang.type = "text";
  inputNamaBarang.classList.add("form-control");
  inputNamaBarang.value = namaBarang;
  inputNamaBarang.readOnly = true;

  var labelGambar = document.createElement("label");
  labelGambar.textContent = "Gambar";
  var inputGambar = document.createElement("input");
  inputGambar.type = "file";
  inputGambar.classList.add("custom-file-input");
  inputGambar.id = "gambar";
  inputGambar.name = "gambar[]";
  inputGambar.accept = "image/*";
  inputGambar.required = true;

  var labelKategori = document.createElement("label");
  labelKategori.textContent = "Kategori";
  var selectKategori = document.createElement("select");
  selectKategori.classList.add("form-control");
  selectKategori.id = "kategori";
  selectKategori.name = "kategori[]";
  selectKategori.required = true;
  selectKategori.onchange = function () {
    checkOtherOption(this);
  };

  // Tambahkan opsi kategori ke dalam select
  var option1 = document.createElement("option");
  option1.value = "";
  option1.textContent = "Pilih Kategori";
  selectKategori.appendChild(option1);

  var option2 = document.createElement("option");
  option2.value = "Furniture";
  option2.textContent = "Furniture";
  selectKategori.appendChild(option2);

  var option3 = document.createElement("option");
  option3.value = "Dekorasi";
  option3.textContent = "Dekorasi";
  selectKategori.appendChild(option3);

  var option4 = document.createElement("option");
  option4.value = "Kebutuhan Kantor";
  option4.textContent = "Kebutuhan Kantor";
  selectKategori.appendChild(option4);

  var option5 = document.createElement("option");
  option5.value = "Elektronik";
  option5.textContent = "Elektronik";
  selectKategori.appendChild(option5);

  var option6 = document.createElement("option");
  option6.value = "Kemasan";
  option6.textContent = "Kemasan";
  selectKategori.appendChild(option6);

  var option7 = document.createElement("option");
  option7.value = "Aksesoris Komputer";
  option7.textContent = "Aksesoris Komputer";
  selectKategori.appendChild(option7);

  var option8 = document.createElement("option");
  option8.value = "Perkakas";
  option8.textContent = "Perkakas";
  selectKategori.appendChild(option8);

  var option9 = document.createElement("option");
  option9.value = "Perlengkapan Rumah Tangga";
  option9.textContent = "Perlengkapan Rumah Tangga";
  selectKategori.appendChild(option9);

  var option10 = document.createElement("option");
  option10.value = "Perawatan Kendaraan";
  option10.textContent = "Perawatan Kendaraan";
  selectKategori.appendChild(option10);

  var option11 = document.createElement("option");
  option11.value = "Suku Cadang Kendaraan";
  option11.textContent = "Suku Cadang Kendaraan";
  selectKategori.appendChild(option11);

  var option12 = document.createElement("option");
  option12.value = "Perlengkapan Pribadi";
  option12.textContent = "Perlengkapan Pribadi";
  selectKategori.appendChild(option12);

  var option13 = document.createElement("option");
  option13.value = "Other";
  option13.textContent = "Other";
  selectKategori.appendChild(option13);

  // Tambahkan elemen hr dan opsi kategori ke dalam div
  inputDiv.appendChild(hr);
  inputDiv.appendChild(labelNamaBarang);
  inputDiv.appendChild(inputNamaBarang);
  inputDiv.appendChild(labelGambar);
  inputDiv.appendChild(inputGambar);
  inputDiv.appendChild(labelKategori);
  inputDiv.appendChild(selectKategori);

  // Menambahkan elemen div baru ke dalam div dengan id "addedInputs"
  var addedInputsDiv = document.getElementById("addedInputs");
  addedInputsDiv.appendChild(inputDiv);
}
