<div>

 <!-- ======= Hero Section ======= -->
 <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Selamat Datang!</h1>
          @if($tagline)
          <h2 class="tag-line">
            {{ $tagline->content }}
          </h2>
          @else
            <h2 class="tag-line">Layanan Les Privat Terpercaya<br>
            Tentor Terbaik Datang Ke Rumah</h2>
          @endif
          <h2 class="area-tag">AREA : 
            @if($area)
              {{ $area->content }}
            @else
            Semarang, Demak, Kudus, Jepara
            @endif
          </h2>
          <div class="d-flex">
            <a href="#about" class="btn-get-started scrollto">Tentang Kami</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img style="width: 100%; " src="/assets/home/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="/assets/home/img/about.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content">
            <h3>Profil Radian Bimbel</h3>
            <p class="">
              @if($about)
              {{ $about->content }}
              @else
              Radian Bimbel adalah sebuah lembaga pendidikan yang berfokus pada bimbingan belajar di rumah atau les privat dengan tentor yang profesional. Kami akan memberikan jaminan kecocokan antara tentor atau pendamping belajar dengan anda.
              @endif
            </p>
            <p>Melayani semua jenjang :</p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-check-circle"></i> PAUD/TK/RA</li>
                  <li><i class="bi bi-check-circle"></i> SD/MI</li>
                  <li><i class="bi bi-check-circle"></i> SMP/MTS</li>
                  <li><i class="bi bi-check-circle"></i> SMA/SMK</li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
              <li><i class="bi bi-check-circle"></i> INTERNATIONAL SCHOOL</li>
              <li><i class="bi bi-check-circle"></i> UTBK</li>
              <li><i class="bi bi-check-circle"></i> OSN/KSN</li>
              <li><i class="bi bi-check-circle"></i> TES KEDINASAN</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- End About Section -->

    <!-- Portfolio 2 Section -->
    <section id="portfolio" class="testimonials section-bg">
      <div class="container">
        <div class="section-title">
          <span>portfolio</span>
          <h2>portfolio</h2>
          <p>Galery foto belajar</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @if ($galleries)
              @foreach ($galleries as $gallery)
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img style="width: 100%" src="/storage/gallery/{{ $gallery->img_gallery }}">
                </div>
              </div>
              @endforeach
            @endif
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    <!-- End Portfolio Section -->

    <section id="layanan-kami" class="layanan">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 pt-4 pt-lg-0 content">
            <h3 class="mb-4">Melayani Semua Mata Pelajaran</h3>
            <div class="row mt-3">
              <div class="col-lg-4 col-md-6">
                <div class="icon-box">
                  <h4 class="title">CALISTUNG</h4>
                  <ul>
                      <li><i class="bi bi-check"></i> BACA</li>
                      <li><i class="bi bi-check"></i> TULIS</li>
                      <li><i class="bi bi-check"></i> HITUNG</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                <div class="icon-box">
                  <h4 class="title">IPA/IPS/BAHASA & MATEMATIKA</h4>
                  <ul>
                      <li><i class="bi bi-check"></i> Fisika, Biologi, Kimia, Matematika</li>
                      <li><i class="bi bi-check"></i> Geografi, Ekonomi, Sejarah, dll</li>
                      <li><i class="bi bi-check"></i> B. Inggris, B. Indonesia, dll</li>
                    </ul>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                <div class="icon-box">
                  <h4 class="title">Tes Kemampuan</h4>
                  <ul>
                      <li><i class="bi bi-check"></i> TPS, TKD, TPA</li>
                      <li><i class="bi bi-check"></i> dan lainnya</li>
                    </ul>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section><!-- End layanan Section -->

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container">
        <div class="row content">
          <h3 class="mb-4">Mengapa Pilih Kami?</h3>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box">
              <h4 class="title">Efektif & Efesien</h4>
              <div class="list-keunggulan">
                <table>
                  <tbody>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Tentor datang ke rumah</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Belajar lebih fokus, intens, komunikatif, dan mudah menyerap materi</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Siswa bebas mengatur jadwal belajar dan mata pelajaran pilihan</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <h4 class="title">Pengajar Profesional</h4>
              <div class="list-keunggulan">
                <table>
                  <tbody>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Tentor terseleksi dari Perguruan Tinggi ternama</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Jaminan kecocokan Tentor</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Pendampingan UTBK free materi dan soal prediksi</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Durasi belajar panjang yaitu 90 menit</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="icon-box">
              <h4 class="title">Mudah & Terjangkau</h4>
              <div class="list-keunggulan">
                <table>
                  <tbody>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Selalu membuka pendaftaran 24 jam</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Cara bayar mudah (Bisa transfer melalui fintech)</td>
                    </tr>
                    <tr>
                      <td><i class="bi bi-check"></i></td>
                      <td>Harga terjangkau</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- End Featured Services Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row counters">
        </div>

      </div>
    </section>
    <!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title">
          <span>Program</span>
          <h2>Program</h2>
          <p>Program les yang kami sediakan</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-home"></i></div>
              <h4>Les Privat Tentor Datang Ke Rumah</h4>
              <p>Private Study (1 Tentor = 1 Siswa)</p>
              <p>Group Study (1 Tentor = 2 – 4 Siswa)</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-desktop"></i></div>
              <h4>Les Privat Online Via Zoom/Google Meet</h4>
              <p>Private Study (1 Tentor = 1 Siswa)</p>
              <p>Group Study (1 Tentor = 2 – 4 Siswa)</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon-day">1 Day</div>
              <h4>Les Kilat Offline atau Online</h4>
              <p>(Pendampingan belajar/tugas/PR/Projek selama sehari)</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Services Section ======= -->
    <section id="area-layanan" class="services section-bg">
      <div class="container-fluid area">

        <div class="section-title">
          <h3>Area Layanan Kami</h3>
        </div>

        <div class="row text-center justify-content-center">
          <div class="col-md-3 les-online border-kanan" style="">
              <h4>LES PRIVAT OFFLINE<br>TENTOR DATANG KE RUMAH</h4>
              <ul class="area-les-offline">
                @if ($area)
                <?php 
                  $areas = explode(',',$area->content);
                ?>
                @foreach ($areas as $v)
                <li><i class="bi bi-geo-alt-fill"></i> {{ $v }}</li>
                @endforeach
                @else
                <li><i class="bi bi-geo-alt-fill"></i> Semarang</li>
                <li><i class="bi bi-geo-alt-fill"></i> Kudus</li>
                <li><i class="bi bi-geo-alt-fill"></i> Demak</li>
                <li><i class="bi bi-geo-alt-fill"></i> Jepara</li>
                @endif
              </ul>
          </div>
          <div class="col-md-3 border-kiri">
              <h4>LES PRIVAT ONLINE<br>via ZOOM/GOOGLE MEET</h4>
              <ul class="area-les-online">
                <li><i class="bi bi-geo-alt-fill"></i> Seluruh Indonesia</li>
              </ul>
          </div>
        </div>

      </div>
    </section>
    <!-- End Services Section -->

    
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <span>Testimoni</span>
          <h2>Testimoni</h2>
          <p>Kumpulan testimoni hasil belajar di Radian Bimbel</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            @if ($testimonials)
              @foreach ($testimonials as $testimoni)
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img style="width: 100%" src="/storage/testimonial/{{ $testimoni->img_testimonial }}">
                </div>
              </div>
              @endforeach
            @endif

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Kontak</span>
          <h2>Kontak</h2>
          <p>Untuk pendaftaran, pertanyaan dan konsultasi silahkan hubungi nomor WhatsApp kami <b>+6289654072027</b></p>
          <a href="https://api.whatsapp.com/send?phone=6289654072027&text=Halo%20kak%2C%20" target="_blank" class="btn btn-success text-center wa-button my-4"><i class="bx bxl-whatsapp"></i> Chat kami</a>
          <p>Atau bisa mendaftar melalui form berikut :</p>
        </div>

        <div class="row">
          <div class="col-lg-12 mt-3 mt-lg-0 d-flex justify-content-center">
            <form role="form" class="php-email-form">
              <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input wire:model="name" type="text" name="name" class="form-control form-control-sm" id="name" required>
                    </div>
                    @error('name')
                    <small class="text-danger">Nama harus diisi minimal 3 karakter</small>
                    @enderror
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="phone">Nomor WhatsApp</label>
                        <input wire:model="phone" type="number" class="form-control form-control-sm" name="phone" id="phone" required>
                    </div>
                    @error('phone')
                    <small class="text-danger">Nomor harus diisi minimal 10 karakter</small>
                    @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mt-3">
                    <label for="city">Kota Domisili</label>
                    <input wire:model="city" type="text" name="city" class="form-control form-control-sm" id="city" required>
                  </div>
                  @error('city')
                  <small class="text-danger">Kota harus diisi minimal 3 karakter</small>
                  @enderror
                </div>
                <div class="col-md-6">
                  <div class="form-group mt-3">
                    <label for="study-type">Program Les</label>
                    <select wire:model="program" name="study-type" id="study-type" class="form-select" aria-label="Default select example" required>
                      <option value="Les Privat Offline">Les Privat Offline</option>
                      <option value="Les Privat Online">Les Privat Online</option>
                      <option value="Les Kilat Offline">Les Kilat Offline</option>
                      <option value="Les Kilat Online">Les Kilat Online</option>
                    </select>
                  </div>
                  @error('program')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="message">Pesan <small class="text-secondary">(optional)</small></label>
                <textarea wire:model="message" class="form-control form-control-sm" id="message" name="message" rows="3"></textarea>
              </div>
              @error('message')
              <small class="text-danger">Maksimal 255 karakter</small>
              @enderror
              @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>
              @elseif(session()->has('failed'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <div class="text-center">
                <button wire:click.prevent="store()" class="btn btn-primary mt-3" type="button">Daftar</button>
                <p style="font-weight: bold; font-size: 15px;" class="my-2">Atau</p>
                <a id="wa-button" class="btn btn-success wa-button" onclick="gotowhatsapp()">Daftar Melalui WhatsApp</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Contact Section -->

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Kosong</h5>
          </div>
          <div class="modal-body">
            Harap lengkapi form pendaftaran terlebih dahulu
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- End #main -->

</div>
