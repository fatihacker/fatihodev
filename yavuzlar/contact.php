<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/arkaplan.css">
    <link rel="shortcut icon" href="assets/img/icon/TheCheethcat" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <header>
        <div class="container">
            <div class="header-wrapper mt-5">
                <div class="row header-content">
                    <div class="header-title col-md-8">
                       
                    </div>
                    <div class="header-menu col-md-4">
                        <ul>
                            <li>
                                <a href="index.php" style="opacity: 100%;">Home</a>
                            </li>
                            <li>
                                <a href="blog.html">Blog</a>
                            </li>
                            <li>
                                <a href="about.html">About</a>
                            </li>
                            <li>
                                <a href="contact.php">Contact</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </header>

    <section id="iletisim">

        <div class="contioner">

            <h1 id="h1iletisim">İletisim </h1>
            <form action="contact.php" method=post>
            <div id="iletisimopak">
                <div id="formgroup">
                    <div id="solform">
                        <input type="text"
                        name="isim"
                        placeholder="Ad Soyad" 
                        required
                        class="form-control">



                        <input type="text"
                        name="tel"
                        placeholder="Telefon Numarası"
                        required
                        class="form-control">
                    </div>
                    <div id="sagform">
                        <input type="email"
                        name="mail"
                        placeholder="Email Adresiniz" 
                        required
                        class="form-control">



                        <input type="text"
                        name="konu"
                        placeholder="Konu Başlığı"
                        required
                        class="form-control">


                        </form>



                    </div>
                        <textarea name="mesaj" id="" placeholder="Mesaj Gir"  cols="" rows="10" required class="form-control" ></textarea>
                <input type="submit" value="Gönder">
                        </div>





                </div>

                <footer>

                    <div id="copyright"></div>

                </footer>

            </div>


            
        </div>
    </section>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı yapılmış kabul ediyoruz. Değişkeninizin adını $baglan olarak kabul edelim.
// Lütfen aşağıdaki bağlantı yapısını gerçek veritabanı bağlantınıza uygun şekilde düzenleyin.

// Örnek MySQLi bağlantı yapısı:
$servername = "localhost";
$username = "kullanici_adi";
$password = "parola";
$dbname = "veritabani_adi";

$baglan = new mysqli($servername, $username, $password, $dbname);
if ($baglan->connect_error) {
    die("Veritabanına bağlanılamadı: " . $baglan->connect_error);
}

// Formun gönderilmiş olup olmadığını kontrol ediyoruz
if (isset($_POST["isim"], $_POST["tel"], $_POST["mail"], $_POST["konu"], $_POST["mesaj"])) {
    // Formdan gönderilen verileri değişkenlere atıyoruz
    $adsoyad = $_POST["isim"];
    $telefon = $_POST["tel"];
    $email = $_POST["mail"];
    $konu = $_POST["konu"];
    $mesaj = $_POST["mesaj"];

    // Güvenlik önlemi için hazırlanmış ifadelerle çalışıyoruz (prepared statement)
    // Veri tabanına güvenli bir şekilde veri eklemek için bu yöntemi tercih ediyoruz.
    $stmt = $baglan->prepare("INSERT INTO iletisim (adsoyad, email, tel, konu, mesaj) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $adsoyad, $email, $telefon, $konu, $mesaj);

    // Veri ekleme işlemini gerçekleştiriyoruz
    if ($stmt->execute()) {
        echo "Mesaj gönderildi";
    } else {
        echo "Hata: " . $stmt->error;
    }

    // İfadeleri kapatıyoruz
    $stmt->close();
}

// Veritabanı bağlantısını kapatıyoruz
$baglan->close();
?>
