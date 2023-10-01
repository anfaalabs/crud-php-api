<?php

require __DIR__ . "/../apps/index.php";

$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);


switch ($request_method) {
  case "GET":
    if (isset($_GET["action"]) && isset($_GET['nim'])) {
      deleteDataByNIM();
      return;
    }

    if (isset($_GET["nim"])) {
      getSingleDataByNIM();
      return;
    }

    getAllData();
    break;

  case "POST":
    addData();
    break;

  case "PUT":
    updateData();
    break;

  default:
    echo api_response(null, null);
    exit();
}




function deleteDataByNIM()
{
  global $connection;

  $nim = $_GET["nim"];

  $query = mysqli_query($connection, "DELETE FROM mahasiswa WHERE nim='" . $nim . "'");

  if ($query) {
    header("location: " . base_url());
    exit();
  } else {
    // set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8', false, 500);

    echo api_response((object) [
      "status" => "error",
      "status_code" => 500,
      "message" => "Gagal menghapus data"
    ], null);
    exit();
  }
}





function getSingleDataByNIM()
{
  global $connection;

  // set header content-type to application/json
  header('Content-Type: application/json; charset=utf-8');

  $nim = $_GET["nim"];

  // Query semua data mahasiswa
  $query = mysqli_query($connection, "SELECT * FROM mahasiswa WHERE nim='" . $nim . "'");


  echo api_response(null, $query->fetch_object());
  exit();
}







function getAllData()
{
  global $connection;

  // set header content-type to application/json
  header('Content-Type: application/json; charset=utf-8');

  // array kosong untuk menampung semua data mahasiswa
  $arr = array();
  // Query semua data mahasiswa
  $query = mysqli_query($connection, "SELECT * FROM mahasiswa ORDER BY nim ASC");


  while ($data = mysqli_fetch_object($query)) {
    array_push($arr, $data);
  }


  echo api_response(null, $arr);
  exit();
}







function addData()
{
  global $connection;

  $body = file_get_contents("php://input");

  // Parse $body string kedalam variable $post
  parse_str($body, $post);


  $nim = $post['nim'];
  $nama = $post['nama'];
  $ttl = $post['ttl'];
  $jurusan = $post['jurusan'];
  $email = $post['email'];

  // Cek apakah ada form yang kosong?
  if (!isset($nim) || !isset($nama) || !isset($ttl) || !isset($jurusan) || !isset($email)) {
    // set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8', false, 400);

    echo api_response((object) [
      "status" => "error",
      "status_code" => 400,
      "message" => "Semua data wajib diisi!"
    ], null);
    exit();
  }


  // Cek NIM mahasiswa
  $cek_nim = mysqli_query($connection, "SELECT * FROM mahasiswa WHERE nim='" . $nim . "'");


  if ($cek_nim->num_rows === 0) {
    // Jika tidak ada data dengan NIM tsb, tambah data baru ke database
    $query = mysqli_query($connection, "INSERT INTO mahasiswa (nim,nama,tempat_tanggal_lahir,jurusan,email) VALUES ('" . $nim . "','" . $nama . "','" . $ttl . "','" . $jurusan . "','" . $email . "')");


    if ($query) {
      header("location: " . base_url());
      exit();
    } else {
      // set header content-type to application/json
      header('Content-Type: application/json; charset=utf-8', false, 500);

      echo api_response((object) [
        "status" => "error",
        "status_code" => 500,
        "message" => "Gagal menambahkan data! silahkan coba lagi."
      ], null);
      exit();
    }
  } else {
    // set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8', false, 409);

    echo api_response((object) [
      "status" => "error",
      "status_code" => 409,
      "message" => "NIM sudah terdaftar!"
    ], null);
    exit();
  }
}







function updateData()
{
  global $connection;

  $body = file_get_contents("php://input");

  // Parse $body string kedalam variable $post
  parse_str($body, $post);

  $nim = $post['nim'];
  $nama = $post['nama'];
  $ttl = $post['ttl'];
  $jurusan = $post['jurusan'];
  $email = $post['email'];

  // Cek apakah ada form yang kosong?
  if (!isset($nim) || !isset($nama) || !isset($ttl) || !isset($jurusan) || !isset($email)) {
    // set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8', false, 400);

    echo api_response((object) [
      "status" => "error",
      "status_code" => 400,
      "message" => "Semua data wajib diisi!"
    ], null);
    exit();
  }


  // Cek NIM mahasiswa
  $cek_nim = mysqli_query($connection, "SELECT * FROM mahasiswa WHERE nim='" . $nim . "'");


  if ($cek_nim->num_rows === 1) {
    // Jika tidak ada data dengan NIM tsb, tambah data baru ke database
    $query = mysqli_query($connection, "UPDATE mahasiswa SET nim='" . $nim . "', nama='" . $nama . "', tempat_tanggal_lahir='" . $ttl . "', jurusan='" . $jurusan . "', email='" . $email . "' WHERE nim='" . $nim . "'");


    if ($query) {
      header("location: " . base_url());
      exit();
    } else {
      // set header content-type to application/json
      header('Content-Type: application/json; charset=utf-8', false, 500);

      echo api_response((object) [
        "status" => "error",
        "status_code" => 500,
        "message" => "Gagal mengupdate data! silahkan coba lagi."
      ], null);
      exit();
    }
  } else {
    // set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8', false, 404);

    echo api_response((object) [
      "status" => "error",
      "status_code" => 404,
      "message" => "Mahasiswa dengan NIM tersebut tidak ada!"
    ], null);
    exit();
  }
}
