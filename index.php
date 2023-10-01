<?php

$meta = (object) [
  "title" => "Hello World!"
];

// include header.php untuk memuat meta tag nya
include __DIR__ . "/components/header.php";

?>

<main class="container-sm px-4">
  <h1>Data Mahasiswa</h1>
  <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, iste sint non mollitia eum aut?</p>

  <!-- Button trigger modal -->
  <button type="button" class="d-block btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalTambahData">
    Tambah Data
  </button>

  <div class="table-responsive mt-2">
    <table class="table table-striped table-hover">
      <thead class="text-nowrap">
        <tr>
          <th>No</th>
          <th>Nama Mahasiswa</th>
          <th>NIM</th>
          <th>Jurusan</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-group-divider text-nowrap">

        <?php
        /**
         * fetch endpoint `/api/mahasiswa` untuk mendapatkan data mahasiswa dalam format json
         */
        $raw = file_get_contents(base_url("/api/mahasiswa"));
        $data = json_decode($raw);

        $no = 1;

        foreach ($data->data as $row) {
          echo "
            <tr>
              <td>" . $no . "</td>
              <td>" . $row->nama . "</td>
              <td>" . $row->nim . "</td>
              <td>" . $row->jurusan . "</td>
              <td>" . $row->email . "</td>
              <td>
                <button type=\"button\" class=\"block btn btn-primary mr-2 button-edit\" data-bs-toggle=\"modal\" data-bs-target=\"#modalEditData\" data-nim=\"" . $row->nim . "\">Edit</button>
                <a class=\"block btn btn-danger\" href=\"" . base_url("api/mahasiswa?nim=" . $row->nim . "&action=hapus") . "\" method=\"POST\">Hapus</a>
              </td>
            </tr>
          ";

          $no += 1;
        }
        ?>

      </tbody>
    </table>
  </div>


  <!-- Modal Tambah Data -->
  <div class="modal fade p-3" id="modalTambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" method="post" action="<?= base_url("api/mahasiswa"); ?>">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body px-3">
          <div class="mb-3">
            <label for="inputNIM" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
            <input type="number" class="form-control" name="nim" id="inputNIM" placeholder="ex: 1234567890">
          </div>

          <div class="mb-3">
            <label for="inputNama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama" id="inputNama" placeholder="ex: John Doe">
          </div>

          <div class="mb-3">
            <label for="inputTTL" class="form-label">Tempat/Tanggal Lahir</label>
            <input type="text" class="form-control" name="ttl" id="inputTTL" placeholder="ex: Jakarta, 10 Oktober 1945">
          </div>

          <div class="mb-3">
            <label for="inputJurusan" class="form-label">Jurusan</label>

            <select class="form-select" id="inputJurusan" name="jurusan" aria-label="Pilih Jurusan">
              <option selected disabled hidden>Pilih Jurusan</option>
              <option value="Teknik Informatika">Teknik Informatika</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Teknik Sipil">Teknik Sipil</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="ex: hi@anfa.my.id">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>


  <!-- Modal Edit Data -->
  <div class="modal fade p-3" id="modalEditData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" id="form-edit-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body px-3">
          <div class="mb-3">
            <label for="editNIM" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
            <input type="number" class="form-control" name="nim" id="editNIM" placeholder="ex: 1234567890">
          </div>

          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama" id="editNama" placeholder="ex: John Doe">
          </div>

          <div class="mb-3">
            <label for="editTTL" class="form-label">Tempat/Tanggal Lahir</label>
            <input type="text" class="form-control" name="ttl" id="editTTL" placeholder="ex: Jakarta, 10 Oktober 1945">
          </div>

          <div class="mb-3">
            <label for="editJurusan" class="form-label">Jurusan</label>

            <select class="form-select" id="editJurusan" name="jurusan" aria-label="Pilih Jurusan">
              <option selected disabled hidden>Pilih Jurusan</option>
              <option value="Teknik Informatika">Teknik Informatika</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Teknik Sipil">Teknik Sipil</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="editEmail" placeholder="ex: hi@anfa.my.id">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</main>


<script type="text/javascript">
  (() => {
    const formControl = {
      edit: {
        form: document.getElementById("form-edit-data"),
        nim: document.getElementById("editNIM"),
        nama: document.getElementById("editNama"),
        ttl: document.getElementById("editTTL"),
        jurusan: document.getElementById("editJurusan"),
        email: document.getElementById("editEmail")
      }
    }



    async function handleEditData(nim = 0) {
      const response = await fetch(`<?= base_url("api/mahasiswa?nim="); ?>${nim}`);
      const data = (await response.json()).data;

      formControl.edit.form.setAttribute("action", `<?= base_url("api/mahasiswa?nim="); ?>${nim}`);

      formControl.edit.nim.value = data.nim;
      formControl.edit.nama.value = data.nama;
      formControl.edit.ttl.value = data.tempat_tanggal_lahir;
      formControl.edit.jurusan.value = data.jurusan;
      formControl.edit.email.value = data.email;
    }



    // Handle form saat diklik update
    document.getElementById("form-edit-data").addEventListener("submit", async (event) => {
      event.preventDefault();

      const data = new URLSearchParams();

      data.append("nim", formControl.edit.nim.value);
      data.append("nama", formControl.edit.nama.value);
      data.append("ttl", formControl.edit.ttl.value);
      data.append("jurusan", formControl.edit.jurusan.value);
      data.append("email", formControl.edit.email.value);

      await fetch(`<?= base_url("api/mahasiswa"); ?>?nim=${formControl.edit.nim.value}`, {
        method: "put",
        body: data
      }).then((res) => {
        if (res.status === 200) {
          window.location.reload();
        }
      });
    });



    [...document.querySelectorAll(".button-edit")].forEach((el) => {
      const nim = el.dataset.nim || el.getAttribute('data-nim');

      el.addEventListener("click", () => handleEditData(nim));
    })
  })();
</script>

<?php include __DIR__ . "/components/footer.php"; ?>