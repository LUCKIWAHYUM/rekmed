@include('components.theme.landing.header')
<section class="container position-relative pt-5 pb-4 py-md-5">
    <div class="row align-items-center justify-content-center mb-2 mb-sm-3" style="height: 35em !important">
      <!-- Text -->
      <div class="col-xl-5 col-md-6 d-flex flex-column order-md-1">
        <div class="text-center text-md-start pt-4 pt-sm-5 pt-xl-0 mt-2 mt-sm-0 mt-lg-auto">
          <h1 class="fs-3 mb-4 text-center">Gaet interaksi website yang optimal dengan <span class="seoType mb-2 fst-italic"></span></h1>
          <p class="fs-lg-3 pt-2 mb-5 text-center">Manfaatkan Guest Post untuk meningkatkan rank website Anda. Dapatkan bayaran untuk apa yang Anda sukai, yaitu membuat konten di website Anda</p>
          <div class="d-flex justify-content-center mb-5">
            <a href="{{ route('marketplace') }}" class="btn btn-primary me-2">
              <i class="bx bx-cart"></i>&nbsp;Mulai Belanja
            </a>
            @auth
                @canSell
                    <a href="{{ site_url('seller', '/') }}" class="btn btn-outline-secondary">
                      <i class="bx bx-right-arrow-alt"></i>&nbsp;Mulai Menulis
                    </a>
                @endCanSell
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                  <i class="bx bx-right-arrow-alt"></i>&nbsp;Mulai Menulis
                </a>
            @endauth
          </div>
        </div>
      </div>
    </div>
</section>

<section class="dark-mode bg-dark position-relative pt-5 pb-4 py-md-5">
    <div class="container">
        <div class="text-center py-4 py-md-0 my-2 my-md-5 mx-auto" style="max-width: 730px;">
          <h2 class="h1">Bagaimana Cara Kerja Guest Post?</h2>
          <p class="mb-0">
            Guest post merupakan sebuah praktik di mana seorang penulis atau ahli dalam suatu bidang menulis dan mengirimkan artikel ke blog atau situs web milik orang lain untuk dipublikasikan. Cara kerja guest post di postamu melibatkan langkah-langkah berikut:
          </p>
        </div>
        <!-- Steps -->
        <div class="steps steps-sm steps-horizontal-md steps-center pb-5 mb-md-2 mb-lg-3 px-4">
          <div class="step">
            <div class="step-number">
              <div class="step-number-inner">1</div>
            </div>
            <div class="step-body">
              <h3 class="h4 mb-3 text-white">Pilih kategori website </h3>
              <p class="mb-0">Pilih kategori website yang cocok dengan website yang ingin Anda bangun.</p>
            </div>
          </div>
          <div class="step">
            <div class="step-number">
              <div class="step-number-inner">2</div>
            </div>
            <div class="step-body">
              <h3 class="h4 mb-3 text-white">Bayar Guest Post</h3>
              <p class="mb-0">Bayar penulis untuk memberikan notifikasi pekerjaan</p>
            </div>
          </div>
          <div class="step">
            <div class="step-number">
              <div class="step-number-inner">3</div>
            </div>
            <div class="step-body">
              <h3 class="h4 mb-3 text-white">Penulis Mulai Bekerja</h3>
              <p class="mb-0">Penulis akan memulai pekerjaannya setelah mendapatkan notifikasi</p>
            </div>
          </div>
          <div class="step">
            <div class="step-number">
              <div class="step-number-inner">4</div>
            </div>
            <div class="step-body">
              <h3 class="h4 mb-3 text-white">Review Hasil</h3>
              <p class="mb-0">Berikan review pada hasil pekerjaan penulis</p>
            </div>
          </div>
        </div>
    </div>
</section>

<!-- How it works (Steps + Video) -->
<section class="container position-relative pt-5 pb-4 py-md-5">
    <div class="container">
        <div class="text-center py-4 py-md-0 my-2 my-md-5 mx-auto">
          <h2 class="h1">Keunggulan Layanan {{ app_info('title') }}</h2>
          <p class="mb-0">
            Kami tentunya menawarkan beragam macam pelayanan yang terbaik dan prima guna dapat memberikan rasa kenyamanan, keamanan serta kredibilitas dari layanan yang terdaftar pada website kami.
          </p>
        </div>
        
        <div class="row">
            <div class="col d-md-flex d-xl-block align-items-center pt-1 pt-sm-2 pt-md-0 pt-xl-3">
              <div class="d-table bg-secondary rounded flex-shrink-0 p-2 mb-3 me-md-3 me-xl-0">
                <img src="{{ pages('third-party/silicon-theme/img/landing/app-showcase/features/statistics.svg') }}" width="19" class="d-block m-1" alt="Icon">
              </div>
              <h3 class="h5 pb-sm-1 mb-2">
                <span class="d-md-none d-xl-block">Backlink Natural</span>
                <span class="fs-base text-nav d-none d-md-block d-xl-none">Backlink Natural</span>
              </h3>
              <p class="fs-sm mb-0 d-md-none d-xl-block">Kami menawarkan backlink berkualitas tinggi yang tercipta secara alami, membantu situs web Anda meningkatkan otoritas dan peringkat SEO dengan cara yang aman dan efektif.</p>
            </div>
            <div class="col d-md-flex d-xl-block align-items-center pt-1 pt-sm-2 pt-md-0 pt-xl-3">
              <div class="d-table bg-secondary rounded flex-shrink-0 p-2 mb-3 me-md-3 me-xl-0">
                <img src="{{ pages('third-party/silicon-theme/img/landing/app-showcase/features/security.svg') }}" width="19" class="d-block m-1" alt="Icon">
              </div>
              <h3 class="h5 pb-sm-1 mb-2">
                <span class="d-md-none d-xl-block">Transaksi Aman</span>
                <span class="fs-base text-nav d-none d-md-block d-xl-none">Transaksi Aman</span>
              </h3>
              <p class="fs-sm mb-0 d-md-none d-xl-block">Keamanan dan privasi pelanggan adalah prioritas utama kami. Kami menjamin setiap transaksi di Postamu.com berjalan dengan aman dan terlindungi sepenuhnya.</p>
            </div>
            <div class="col d-md-flex d-xl-block align-items-center pt-1 pt-sm-2 pt-md-0 pt-xl-3">
              <div class="d-table bg-secondary rounded flex-shrink-0 p-2 mb-3 me-md-3 me-xl-0">
                <img src="{{ pages('third-party/silicon-theme/img/landing/app-showcase/features/happy.svg') }}" width="19" class="d-block m-1" alt="Icon">
              </div>
              <h3 class="h5 pb-sm-1 mb-2">
                <span class="d-md-none d-xl-block">Bebas Pilih Website</span>
                <span class="fs-base text-nav d-none d-md-block d-xl-none">Bebas Pilih Website</span>
              </h3>
              <p class="fs-sm mb-0 d-md-none d-xl-block">Anda memiliki kebebasan untuk memilih situs web yang sesuai dengan niche atau industri Anda. Dengan beragam pilihan website berkualitas, Anda bisa memaksimalkan potensi backlink untuk meningkatkan visibilitas online.</p>
            </div>
            <div class="col d-md-flex d-xl-block align-items-center pt-1 pt-sm-2 pt-md-0 pt-xl-3">
              <div class="d-table bg-secondary rounded flex-shrink-0 p-2 mb-3 me-md-3 me-xl-0">
                <img src="{{ pages('third-party/silicon-theme/img/landing/app-showcase/features/cashback.svg') }}" width="19" class="d-block m-1" alt="Icon">
              </div>
              <h3 class="h5 pb-sm-1 mb-2">
                <span class="d-md-none d-xl-block">Harga Transparan</span>
                <span class="fs-base text-nav d-none d-md-block d-xl-none">Harga Transparan</span>
              </h3>
              <p class="fs-sm mb-0 d-md-none d-xl-block">Kami menyediakan harga yang jelas dan transparan tanpa biaya tersembunyi. Dengan demikian, Anda dapat merencanakan anggaran dengan tepat dan mendapatkan nilai maksimal dari investasi backlink Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials (Slider) -->
<section class="container pb-5 mb-md-2 mb-xl-4">
<div class="row pb-lg-2">
  <div class="col-md-5 mb-4 mb-md-0">
    <div class="card justify-content-center bg-dark h-100 p-4 p-lg-5">
      <div class="p-2">
        <h3 class="display-4 text-primary mb-1">200+</h3>
        <h2 class="text-light pb-5 mb-2">Klien Sudah Dilayani</h2>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card border-0 shadow-sm p-4 p-xxl-5">

      <!-- Slider prev/next buttons + Quotation mark -->
      <div class="d-flex justify-content-between pb-4 mb-2">
        <span class="btn btn-icon btn-primary btn-lg shadow-primary pe-none">
          <i class="bx bxs-quote-left"></i>
        </span>
        <div class="d-flex">
          <button type="button" id="testimonial-prev" class="btn btn-prev btn-icon btn-sm me-2">
            <i class="bx bx-chevron-left"></i>
          </button>
          <button type="button" id="testimonial-next" class="btn btn-next btn-icon btn-sm ms-2">
            <i class="bx bx-chevron-right"></i>
          </button>
        </div>
      </div>   
      
      <!-- Slider -->
      <div class="swiper mx-0 mb-md-n2 mb-xxl-n3" id="review-swiper" data-swiper-options=''>
        <div class="swiper-wrapper">

          <!-- Item -->
          <div class="swiper-slide h-auto" data-swiper-tab="#author-1">
            <figure class="card h-100 position-relative border-0 bg-transparent">
              <blockquote class="card-body p-0 mb-0">
                <p class="fs-lg mb-0">Saya sangat terbantu dengan jasa backlink dari Postamu.com! Backlink natural yang mereka tawarkan benar-benar membantu situs web saya meningkatkan peringkat di mesin pencari. Hasilnya luar biasa! Terima kasih, Postamu.com!</p>
              </blockquote>
              <figcaption class="card-footer border-0 d-flex align-items-center w-100 pb-2">
                <div class="ps-3">
                  <h5 class="fw-semibold lh-base mb-0">Budi Prasetyo</h5>
                </div>
              </figcaption>
            </figure>
          </div>

          <!-- Item -->
          <div class="swiper-slide h-auto" data-swiper-tab="#author-2">
            <figure class="card h-100 position-relative border-0 bg-transparent">
              <blockquote class="card-body p-0 mb-0">
                <p class="fs-lg mb-0">Pengalaman menggunakan jasa backlink dari Postamu.com sangat menyenangkan. Transaksinya aman dan cepat, serta saya bebas memilih situs web yang relevan dengan bisnis saya. Situs web saya kini semakin terkenal dan mengalami pertumbuhan trafik yang signifikan!</p>
              </blockquote>
              <figcaption class="card-footer border-0 d-flex align-items-center w-100 pb-2">
                <div class="ps-3">
                  <h5 class="fw-semibold lh-base mb-0">Anita Sari</h5>
                </div>
              </figcaption>
            </figure>
          </div>

          <!-- Item -->
          <div class="swiper-slide h-auto" data-swiper-tab="#author-3">
            <figure class="card h-100 position-relative border-0 bg-transparent">
              <blockquote class="card-body p-0 mb-0">
                <p class="fs-lg mb-0">Postamu.com memberikan pelayanan yang sangat baik. Harga yang transparan membuat saya merasa nyaman dan yakin dengan investasi backlink saya. Situs web saya kini lebih dikenal dan mampu bersaing di pasar yang ketat. Terima kasih banyak!</p>
              </blockquote>
              <figcaption class="card-footer border-0 d-flex align-items-center w-100 pb-2">
                <div class="ps-3">
                  <h5 class="fw-semibold lh-base mb-0">Hadi Nugroho</h5>
                </div>
              </figcaption>
            </figure>
          </div>

          <!-- Item -->
          <div class="swiper-slide h-auto" data-swiper-tab="#author-4">
            <figure class="card h-100 position-relative border-0 bg-transparent">
              <blockquote class="card-body p-0 mb-0">
                <p class="fs-lg mb-0">Ini adalah pengalaman pertama saya menggunakan jasa backlink, dan Postamu.com membuatnya begitu mudah dan menyenangkan. Backlink natural yang mereka sediakan benar-benar memberikan dampak positif pada peringkat situs web saya. Saya sangat puas dengan hasilnya!</p>
              </blockquote>
              <figcaption class="card-footer border-0 d-flex align-items-center w-100 pb-2">
                <div class="ps-3">
                  <h5 class="fw-semibold lh-base mb-0">Rina Wijaya</h5>
                </div>
              </figcaption>
            </figure>
          </div>

          <!-- Item -->
          <div class="swiper-slide h-auto" data-swiper-tab="#author-5">
            <figure class="card h-100 position-relative border-0 bg-transparent">
              <blockquote class="card-body p-0 mb-0">
                <p class="fs-lg mb-0">Saya ingin merekomendasikan Postamu.com kepada siapa pun yang membutuhkan layanan backlink berkualitas. Saya benar-benar terkesan dengan profesionalisme tim mereka dan hasil yang mereka berikan. Situs web saya kini lebih teroptimasi dan mampu menarik lebih banyak pengunjung. Postamu.com, kalian hebat!</p>
              </blockquote>
              <figcaption class="card-footer border-0 d-flex align-items-center w-100 pb-2">
                <div class="ps-3">
                  <h5 class="fw-semibold lh-base mb-0">Dedy Kurniawan</h5>
                </div>
              </figcaption>
            </figure>
          </div>
        </div>

        <!-- Pagination (bullets) -->
        <div class="swiper-pagination position-relative pt-3 mt-4"></div>
      </div>        
    </div>
  </div>
</div>
</section>

<!-- News slider -->
<section class="dark-mode bg-dark py-5 px-4" id="blog-section">
    <div class="container justify-content-center py-md-3 py-lg-5">
      <h2 class="h1 text-center mb-2">Informasi Terbaru</h2>
      <p class="mb-0 text-center">Temukan beragam macam informasi terkini seputar blogging maupun non blogging</p>
      <div class="position-relative mx-md-2 px-md-5 pt-5">
        <!-- Swiper slider -->
        @if(count($getAllPost) > 0)
            <div class="swiper swiper-nav-onhover justify-content-center align-items-center" id="blog-swiper">
                @foreach($getAllPost as $post)
                    <div class="swiper-slide h-auto w-25 py-3">
                        <article class="card p-md-3 p-2 border-0 shadow-sm card-hover-primary h-100 mx-2">
                            <div class="card-body pb-0">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge fs-sm text-nav bg-secondary text-decoration-none position-relative zindex-2">{{ $post->category->first()->name }}</span><br>
                                </div>
                                <h6>
                                    <a href="{{ route('blog.detail', $post->slug) }}" class="text-justify">{{ substr($post->title, 0, 40) . '...' }}</a>
                                </h6>
                                <p class="mb-0">{!! substr($post->description, 0, 70) . '...' !!}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="mb-0 text-center text-muted">Tidak ditemukan informasi terbaru...</p>
        @endif
      </div>
    </div>
</section>

<!-- CTA -->
<section class="position-relative py-5">
    <span class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(255, 255, 255, .05)"></span>
    <div class="container position-relative zindex-5 text-center my-xl-3 py-1 py-md-4 py-lg-5">
        <p class="fs-lg mb-4">Tertarik untuk menulis dan mendapatkan penghasilan?</p>
        <h2 class="h1 mb-4">Mulai perjalanan Guest Postmu dengan kami<span class="ms-2">&#128640;</span></h2>
        @auth
            @if(user()->level == enum('isAdmin'))
                <a href="{{ app_url('dashboard') }}" class="btn btn-primary shadow-primary mt-4"><i class="bx bx-right-arrow-alt me-2"></i>Kembali ke Laman</a>
            @else
                @canSell
                    <a href="{{ site_url('seller', '/') }}" class="btn btn-primary shadow-primary mt-4"><i class="bx bx-right-arrow-alt me-2"></i>Kembali ke Toko</a>
                @else
                    <a href="{{ site_url('user', 'activate') }}" class="btn btn-primary shadow-primary mt-4"><i class="bx bx-right-arrow-alt me-2"></i>Daftar sebagai Toko</a>
                @endCanSell
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-primary shadow-primary mt-4"><i class="bx bx-right-arrow-alt me-2"></i>Gabung sekarang</a>
        @endauth
    </div>
</section>
@push('scripts')
    $(document).ready(() => {
        var typed = new Typed('.seoType', {
          strings: ['search engine optimization', 'konten yang berkualitas', 'ads'],
          typeSpeed: 50,
          fadeOut: true,
          loop: true
        });
        
        const blog_swiper = new Swiper('#blog-swiper', {
            "slidesPerView": 1,
            "centeredSlides": false,
            "spaceBetween": 8,
            "loop": false,
            "pagination": {
              "el": ".swiper-pagination",
              "clickable": true
            },
            "breakpoints": {
              "500": {
                "slidesPerView": 2,
                "spaceBetween": 24
              },
              "1000": {
                "slidesPerView": 3,
                "spaceBetween": 24
              },
              "1500": {
                "slidesPerView": 5,
                "spaceBetween": 24
              }
            }
        })
    })
@endpush
@include('components.theme.landing.footer')