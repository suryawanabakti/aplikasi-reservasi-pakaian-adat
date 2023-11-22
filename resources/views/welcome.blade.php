<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Adat Kajang</title>
    <!-- All CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <style>
        .opacity:hover {
            opacity: 0.8;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="text-warning">ADAT</span>KAJANG</a> <button
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
                type="button"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#event">Event</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#galery">Galery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#peta">Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img alt="..." class="d-block w-100" src="https://jadesta.kemenparekraf.go.id/imgpost/27109.jpg">
                <div class="carousel-caption">
                    <h5>WISATA ADAT KAJANG</h5>
                    <p>
                        MASYARAKAT Adat Kajang merupakan salah satu suku yang hidup di Sulawesi Selatan. Mereka tinggal
                        di Kabupaten Bulukumba yang berjarak kurang lebih 200 kilometer dari pusat Kota Makassar.
                    </p>
                    <p><a class="btn btn-warning mt-3" href="/home">RESERVASI</a></p>
                </div>
            </div>
        </div>

    </div><!-- about section starts -->
    <section class="contact section-padding" id="event">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Event</h2>
                    </div>
                    <div class="section-body ">
                        <div class="row">
                            @foreach ($events as $event)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" src="/uploads/image/{{ $event->image }}"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->name }}</h5>
                                            <p class="card-text">{{ str()->limit($event->description) }}</p>
                                            <small>{{ $event->tanggal_mulai }} s/d {{ $event->tanggal_selesai }}</small>
                                            <br>
                                            <button type="button" class="btn btn-primary btn-sm mt-4"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $event->id }}">
                                                Detail
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $event->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ $event->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <b>Deskripsi</b> <br>
                                                            <p>{{ $event->description }}</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <!--for getting the form download the code from download button-->
                </div>
            </div>
        </div>
    </section>
    <section class="contact section-padding" id="galery">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Galery</h2>
                    </div>
                    <div class="section-body text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <img title="Balla to kajang"
                                    src="https://img.inews.co.id/media/600/files/networks/2023/01/01/2debd_rumah.jpg"
                                    alt="Balla to kajang" class="img img-fluid opacity" data-bs-toggle="modal"
                                    data-bs-target="#modal1">
                                <!-- Modal -->
                                <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Balla To Kajang
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Balla To Kajang merupakan salah satu rumah masyarakat adat dari daerah
                                                Kajang, Bulukumba, Sulawesi Selatan. Rumah adat ini masih eksis sampai
                                                sekarang. Rumah ini dibangun berkelompok berdasarkan sistem kekerabatan
                                                terdekat. Setiap kelompok rumah dibatasi pagar hidup atau pagar batu
                                                yang di dalamnya terdiri atas tiga rumah batu lebih. Salah satu dari
                                                ketiga rumah tersebut dijadikan rumah keluarga, rumah tinggal sementara
                                                atau rumah mukim alternatif ketika ada tamu bertandang.

                                                Konstruksi rumah adat Kajang pada umumnya ramah lingkungan karena
                                                menggunakan bahan-bahan alami seperti daun nipa dan alang-alang sebagai
                                                atap, ijuk dan rotan sebagai pengikat serta bambu sebagai lantai dan
                                                dinding. Rumah masyarakat adat Kajang tidak terlalu banyak menggunakan
                                                kayu. Untuk membangun sebuah rumah hanya diperlukan tiga balok pasak
                                                atau sulur bawah (padongko) yang melintang dari sisi kiri ke sisi kanan
                                                rumah. Untuk mengikat kesatuan tiang dalam satu jejeran (latta') pada
                                                bagian atas rumah diletakkan balok besar yang melintang dari sisi kiri
                                                ke kanan.

                                                Rumah bagi masyarakat adat Kajang merupakan mikrokosmos dari hutan adat.
                                                Dengan demikian, pemakaian balok (padongko dan lilikang) tersebut
                                                merupakan simbolisasi dari tangkai-tangkai kayu pada sebatang pohon,
                                                yang diasosiasikan dengan tiang-tiang rumah.
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img title="Ritual andingingi" alt="Ritual andingingi"
                                    src="https://img.kliknusae.com/uploads/2018/09/ritual.jpg"
                                    class="img img-fluid opacity" data-bs-toggle="modal" data-bs-target="#modal2">
                                <div class="modal fade" id="modal2" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ritual Andingingi
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tradisi lokal Suku Kajang tersebut dinamakan Andingingi. Andingingi
                                                dapat dikatakan ritual mendinginkan alam dan isinya serta dianggap
                                                ritual ini memohon atas keselamatan. Dan semua orang yang hadir pada
                                                acara Andingingi harus menggunakan pakaian serba hitam yang disakralkan
                                                oleh masyarakat Suku Kajang.
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <img title="Battasa jera" alt="Battasa jera"
                                    src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2022/04/27/3512813740.jpeg"
                                    class="img img-fluid opacity" data-bs-toggle="modal" data-bs-target="#modal3">
                                <div class="modal fade" id="modal3" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Battasa Jera</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Battasa Jera’, Salah Satu Tradisi Warga Kajang Jelang RamadhanBeberapa
                                                tradisi unik yang biasa di lakukan umat Islam saat jelang bulan Ramadhan
                                                salah satunya Battasa jera’ atau membersihkan kuburan yang di lakukan
                                                oleh masyarakat Kajang Kabupaten Bulukumba setiap seminggu menjelang
                                                bulan yang penuh berkah itu.

                                                Battasa Jera’ atau membersihkan kuburan merupakan prosesi yang wajib dan
                                                rutin di laksanakan warga kajang tiap tahunnya, kegiatan ini sudah
                                                dilaksanakan turun-temurun sejak ratusan tahun silam, sejak Ammatoa
                                                pertama di Kajang.


                                                Adapun tujuan dilakukannya kegiatan Battasa Jera’ ini adalah untuk
                                                menghargai dan memberikan doa keselamatan akhirat bagi para arwah nenek
                                                moyang, maupun keluarganya yang telah meninggal dunia.
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <img title="Attunu panroli" alt="Attunu panroli"
                                    src="https://sumeks.disway.id/upload/7dbc2cb4ae1008dfb4a92afb1b4eae8a.jpg"
                                    class="img img-fluid opacity" data-bs-toggle="modal" data-bs-target="#modal4">
                                <div class="modal fade" id="modal4" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Attunu Panroli
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                attunu panroli Ritual itu biasanya dilaksanakan dalam upacara adat yang
                                                melibatkan seluruh masyarakat suku kajang jika terdapat masalah. Di
                                                antaranya terjadi kasus pencurian di tengah pemukiman masyarakat adat.

                                                "Seluruh masyarakat wajib kumpul tanpa terkecuali mereka yang diduga
                                                sebagai pelaku pencurian di sebuah lapangan tempat upacara adat itu
                                                digelar. Upacara sendiri dipimpin langsung oleh ketua adat yang bergelar
                                                Ammatoa,"Setelah semua masyarakat adat dan mereka yang dicurigai sebagai
                                                maling itu berkumpul dalam prosesi upacara attunu panroli, sambung
                                                Rampe, linggis pun mulai dibakar dalam api yang membara hingga linggis
                                                berubah menjadi warna kemerahan. Selang beberapa jam lalui proses
                                                pembakaran, linggis pun tampak sudah berubah menjadi warna kemerahan
                                                pertanda besinya sudah sangat panas.

                                                Ammatoa yang memimpin ritual itu pun mengingatkan masyarakat yang hadir
                                                jika linggis ini tidak akan pernah terasa panas jika dipegang oleh
                                                seseorang yang bersifat jujur. Tapi jika sedikit pun ia tak jujur maka
                                                linggis panas ini akan melumat tangannya.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <img title="Tarian pa'bitte passapu" alt="Tarian pa'bitte passapu"
                                    src="https://media.suara.com/pictures/653x366/2017/11/04/31892-suku-adat-kajang-ammatoa.jpg"
                                    class="img img-fluid opacity" data-bs-toggle="modal" data-bs-target="#modal5">
                                <div class="modal fade" id="modal5" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tarian pa'bitte
                                                    passapu</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tarian "Pa'bitte Passapu" merupakan tarian adat Ammatoa Kajang,
                                                Kabupaten Bulukumba, Sulawesi Selatan. ... Sekarang ini,"Pa'bitte
                                                Passapu" menjadi tarian untuk menjemput tamu adat atau acara pernikahan.
                                                Tarian ini diiringi nyanyian dan alat musik sembari menyabung sapu
                                                tangan atau pun ikat kepala.
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <img title="Sajian songkolo dalam ritual andingingi"
                                    alt="Sajian songkolo dalam ritual andingingi"
                                    src="https://jadesta.kemenparekraf.go.id/imgpost/27109.jpg"
                                    class="img img-fluid opacity" data-bs-toggle="modal" data-bs-target="#modal6">
                                <div class="modal fade" id="modal6" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Sajian Songkolo
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sajian Songkolo merupakan bagian dari ritual adat yang dilakukan dalam
                                                budaya Di kawasan ketika ammatoa kajang ketika Sulawesi Selatan,
                                                Indonesia. Biasanya ini dilakukan dalam upacara adat atau ritual yang
                                                dipimpin oleh seorang pemimpin adat yang disebut Ammatoa di Kabupaten
                                                Bulukumba.
                                                Sajian Songkolo sering kali menjadi bagian penting dalam acara adat
                                                untuk menyambut tamu penting, perayaan keagamaan, pernikahan, atau
                                                acara adat lainnya.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <!--for getting the form download the code from download button-->
                </div>
            </div>
        </div>
    </section>
    <section class="contact section-padding" id="peta">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Peta</h2>
                    </div>
                    <div class="section-body text-center">
                        <img src="https://jadesta.kemenparekraf.go.id/imgpost/56419.jpg" alt=""
                            class="img img-fluid">
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <!--for getting the form download the code from download button-->
                </div>
            </div>
        </div>
    </section>
    <!-- Contact starts -->
    <section class="contact section-padding" id="contact">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Contact Us</h2>

                    </div>
                    <div class="section-body text-center">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127120.20030234782!2d120.24733356001249!3d-5.339401959836184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbc1a6e53444d13%3A0x4030bfbcaf77750!2sKec.%20Kajang%2C%20Kabupaten%20Bulukumba%2C%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1694000503191!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <!--for getting the form download the code from download button-->
                </div>
            </div>
        </div>
    </section>
    <!-- contact ends -->
    <!-- footer starts -->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-white">All Right Reserved By @website Name</p>
        </div>
    </footer>
    <!-- footer ends -->

    <!-- All Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
