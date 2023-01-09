<?php
include("header.php");

if ($_SESSION['akses'] == 2 || empty($_SESSION['akses'])) {

  $id_kategori = $_GET['id_kategori'];

  if(isset($_POST['add_to_cart'])){
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $total_harga = $_POST['total_harga'];
    $gambar = $_POST['gambar'];
    $qty = 1;

    $data = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE nama_menu = '$nama_menu' AND id_user = '$idUser'");
    $cek = mysqli_num_rows($data);

    if($cek > 0){
     $message[] = 'Sudah ditambakan ke keranjang!';
     echo "<script>alert('Sudah ditambakan ke keranjang!')</script>";
   }else{
     $insert_keranjang = mysqli_query($koneksi,"INSERT INTO keranjang VALUES (NULL, '$idUser', '$id_menu', '$nama_menu', '$qty', '$total_harga', '$gambar')");
     $message[] = 'Ditambakan ke keranjang!';
     echo "<script>alert('Ditambakan ke keranjang!')</script>"; 
   }
 }
 ?>

 <br>
 <br>

 <body>

  <!-- popular section starts  -->
  <section id="menu" class="what-we-do">
    <div class="container">
      <?php 
      if ($id_kategori == 0) {
       ?>
       <div class="section-title">
        <h2>Menu</h2>
      </div>

      <div class="row">
        <?php 
        if(isset($_POST['search'])){
          $s = $_POST['search'];
          $batas = 100;
          $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
          $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  

          $previous = $halaman - 1;
          $next = $halaman + 1;

          $data = mysqli_query($koneksi,"SELECT * FROM menu where nama_menu like '%$s%' order by id_menu;");
          $jumlah_data = mysqli_num_rows($data);
          $total_halaman = ceil($jumlah_data / $batas);

          $data_menu = mysqli_query($koneksi,"SELECT * FROM menu where nama_menu like '%$s%' order by id_menu LIMIT $halaman_awal, $batas");
          $nomor = $halaman_awal+1;

          if($jumlah_data > 0){

            while($s = mysqli_fetch_array($data_menu)){
              ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-0" style="margin-bottom: 30px;">
                <div class="card icon-box" style="border-radius: 20px;">
                  <form action="" method="POST">
                    <input type="hidden" name="id_menu" value="<?php echo $s['id_menu'] ?>">
                    <input type="hidden" name="nama_menu" value="<?php echo $s['nama_menu'] ?>">
                    <input type="hidden" name="total_harga" value="<?php echo $s['harga'] ?>">
                    <input type="hidden" name="gambar" value="<?php echo $s['gambar'] ?>">

                    <div class="img">
                      <img src="assets/img/menu/<?php echo $s['gambar']; ?>" alt="" width="300px" height="250px" style="border-radius: 20px;">
                    </div>
                    <br>
                    <h4><a href="product_detail.php?id_menu=<?php echo $s['id_menu'] ?>"><?php echo $s['nama_menu']; ?></a></h4>
                    <h5 class="text-secondary" style="font-family: 'Open Sans', sans-serif;"><?php echo rupiah($s['harga']); ?></h5>
                    <div>
                      <a href="product_detail.php?id_menu=<?php echo $s['id_menu'] ?>" class="btn m-2 pt-2 pb-2" style="color: #E8853D;">Detail Menu</a>
                      <?php 
                      if(isset($_SESSION['id'])) {
                        ?>
                        <a href="" ><button class="btn m-2" style="background-color: #E8853D;" type="submit" name="add_to_cart">
                          <span style="color: #fff; font-size: 20px" class="bi-cart2"></span>
                        </button></a>
                      </div>
                    </div>
                  </div>
                </form>
                <?php 
              }else{ 
                ?>
                <button class="btn m-2" style="background-color: #E8853D;">
                  <a onclick="return confirm('Silahkan Login Terlebih Dahulu!')" href="login.php" style="color: #fff; font-size: 20px"><span class="bi-cart2"></span></a>
                </button>
              </div>
            </div>
          </div>
          <?php 
        }
      }
    }else{
      ?>
      Menu Tidak Ditemukan!
      <?php
    }
  }else{
    $batas = 100;
    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  

    $previous = $halaman - 1;
    $next = $halaman + 1;

    $data = mysqli_query($koneksi,"SELECT * FROM menu;");
    $jumlah_data = mysqli_num_rows($data);
    $total_halaman = ceil($jumlah_data / $batas);

    $data_menu = mysqli_query($koneksi,"SELECT * FROM menu LIMIT $halaman_awal, $batas");
    $nomor = $halaman_awal+1;
    while($d = mysqli_fetch_array($data_menu)){
      ?>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-0" style="margin-bottom: 30px;">
        <div class="card icon-box" style="border-radius: 20px;">
          <form action="" method="POST">
            <input type="hidden" name="id_menu" value="<?php echo $d['id_menu'] ?>">
            <input type="hidden" name="nama_menu" value="<?php echo $d['nama_menu'] ?>">
            <input type="hidden" name="total_harga" value="<?php echo $d['harga'] ?>">
            <input type="hidden" name="gambar" value="<?php echo $d['gambar'] ?>">

            <div class="img">
              <img src="assets/img/menu/<?php echo $d['gambar']; ?>" alt="" width="300px" height="250px" style="border-radius: 20px;">
            </div>
            <br>
            <h4><a href="product_detail.php?id_menu=<?php echo $d['id_menu'] ?>"><?php echo $d['nama_menu']; ?></a></h4>
            <h5 class="text-secondary" style="font-family: 'Open Sans', sans-serif;"><?php echo rupiah($d['harga']); ?></h5>
            <div>
              <a href="product_detail.php?id_menu=<?php echo $d['id_menu'] ?>" class="btn m-2 pt-2 pb-2" style="color: #E8853D;">Detail Menu</a>
              <?php 
              if(isset($_SESSION['id'])) {
                ?>
                <a href="" ><button class="btn m-2" style="background-color: #E8853D;" type="submit" name="add_to_cart">
                  <span style="color: #fff; font-size: 20px" class="bi-cart2"></span>
                </button></a>
              </div>
            </div>
          </div>
        </form>
        <?php 
      }else{ 
        ?>
        <button class="btn m-2" style="background-color: #E8853D;">
          <a onclick="return confirm('Silahkan Login Terlebih Dahulu!')" href="login.php" style="color: #fff; font-size: 20px"><span class="bi-cart2"></span></a>
        </button>
      </div>
    </div>
  </div>
  <?php 
}
}
}
}else{

  $batas = 100;
  $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
  $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  

  $previous = $halaman - 1;
  $next = $halaman + 1;

  $data = mysqli_query($koneksi,"SELECT * FROM menu JOIN kategori ON menu.id_kategori = kategori.id_kategori WHERE menu.id_kategori='$id_kategori';");
  $jumlah_data = mysqli_num_rows($data);
  $total_halaman = ceil($jumlah_data / $batas);

  $data_menu = mysqli_query($koneksi,"SELECT * FROM menu JOIN kategori ON menu.id_kategori = kategori.id_kategori WHERE menu.id_kategori='$id_kategori' LIMIT $halaman_awal, $batas");
  $nomor = $halaman_awal+1;
  $c = mysqli_fetch_array($data);
  ?>

  <div class="section-title">
    <h2>Kategori <?php echo $c['nama_kategori'] ?></h2>
  </div>
  <div class="row">

    <?php
    while($d = mysqli_fetch_array($data_menu)){
      ?>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-0" style="margin-bottom: 30px;">
        <div class="card icon-box" style="border-radius: 20px;">
          <form action="" method="POST">
            <input type="hidden" name="id_menu" value="<?php echo $d['id_menu'] ?>">
            <input type="hidden" name="nama_menu" value="<?php echo $d['nama_menu'] ?>">
            <input type="hidden" name="total_harga" value="<?php echo $d['harga'] ?>">
            <input type="hidden" name="gambar" value="<?php echo $d['gambar'] ?>">

            <div class="img">
              <img src="assets/img/menu/<?php echo $d['gambar']; ?>" alt="" width="300px" height="250px" style="border-radius: 20px;">
            </div>
            <br>
            <h4><a href="product_detail.php?id_menu=<?php echo $d['id_menu'] ?>"><?php echo $d['nama_menu']; ?></a></h4>
            <h5 class="text-secondary" style="font-family: 'Open Sans', sans-serif;"><?php echo rupiah($d['harga']); ?></h5>
            <div>
              <a href="product_detail.php?id_menu=<?php echo $d['id_menu'] ?>" class="btn m-2 pt-2 pb-2" style="color: #E8853D;">Detail Menu</a>
              <?php 
              if(isset($_SESSION['id'])) {
                ?>
                <a href="" ><button class="btn m-2" style="background-color: #E8853D;" type="submit" name="add_to_cart">
                  <span style="color: #fff; font-size: 20px" class="bi-cart2"></span>
                </button></a>
              </div>
            </div>
          </div>
        </form>
        <?php 
      }else{ 
        ?>
        <button class="btn m-2" style="background-color: #E8853D;">
          <a onclick="return confirm('Silahkan Login Terlebih Dahulu!')" href="login.php" style="color: #fff; font-size: 20px"><span class="bi-cart2"></span></a>
        </button>
      </div>
    </div>
  </div>
  <?php 
}
}
} 
?>
</div>    
</div>
</section>
<!-- End Section -->

</body>

<?php
}else{

  echo "<script>alert('Anda adalah Admin!')</script>";
  echo "<script>location='dashboard/'</script>"; 
}
include "footer.php";
?>