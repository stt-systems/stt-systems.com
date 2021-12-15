<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page');
?>
<!--
<div class="container-fluid front-page main">
  <div class="row">
    <div class="col-md-6 col-xs-12 panel">
      <a class='linkBlock' href="<?php echo get_page_permalink("motion-analysis"); ?>">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12">
          <div class="content-box">
            <img src="<?php echo get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/motion-analysis-single.png"); ?>" alt="Motion analysis solution" />
            <h1>Motion Analysis Solutions</h1>
            <h3><?php _e("Premium technologies for human motion studies. Ready to use by sports scientists, clinicians and researchers", "default"); ?></h3>
          </div>
        </div>
        <div class="col-md-2"></div>
      </a>
      <div id='panelLeft' class="panel-bg bottom left"></div>
    </div>
    <div class="col-md-6 col-xs-12 panel">
      <a class='linkBlock' href="<?php echo get_page_permalink("industry"); ?>">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12">
          <div class="content-box">
            <img src="<?php echo get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/industry-single.png"); ?>" alt="Industry 4.0" />
            <h1>Industry 4.0</h1>
            <h3><?php _e("Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes", "default"); ?></h3>
          </div>
        </div>
        <div class="col-md-2"></div>
      </a>
      <div id='panelRight' class="panel-bg bottom right"></div>
    </div>
  </div>
</div>
  <div class="container" id="seccion2-home">
    <div class="row">
      <h2 class="text-center"><?php _e("20 years creating motion capture systems", "default")?></h2>
      <div class="col-md-6 col-sm-12 text-center">
        <img src="/wp-content/uploads/golf-motion-analysis.jpg" alt="Golf motion analysis">
      </div>
      <div class="col-md-6 col-sm-12">
        <p><?php _e("STT systems was created by a group of engineers in 1998 in San Sebastian, with the aim of devising high quality <strong>motion capture technology</strong>. We work on the creation of multiple <strong>motion analysis</strong> products with different objectives, such as clinical studies, sport researchers or biomechanics. These products include both <strong>motion capture software</strong> and hardware, creating ready to be used and complete motion analysis systems.", "default")?></p>
        <p><?php _e("More specifically, most of our activity is focused on the development of <strong>3d motion capture</strong> systems for sport and human studies. For example, we create advanced systems to facilitate <strong>running, cycling or golf motion analysis</strong>. In addition to all this, we also create image processing software and hardware for industrial purposes. We invite you to browse our website and discover all these products and services in more depth.", "default")?></p>
      </div>
    </div>
  </div>
-->
<div id="temporal-css">
    <div class="container-fluid front-page main">
        <div class="row">
            <div id="mainHomeHeader" class="col-md-12 col-xs-12">
                <h1>STT Systems</h1>
            </div>
            <div class="col-md-6 col-xs-12 panel">
                <a class='linkBlock' href="<?php echo get_page_permalink("motion-analysis"); ?>">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-sm-12">
                        <div class="content-box">
                            <img src="<?php echo get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/motion-analysis-single.png"); ?>" alt=<?php _e("Motion analysis solution"); ?> />
                            <h2 class="secondaryHomeHeader"><?php _e("Motion Analysis Solutions"); ?></h2>
                            <h3><?php _e("Premium technologies for human motion studies. Ready to use by sports scientists, clinicians and researchers", "default"); ?></h3>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </a>
                <div id='panelLeft' class="panel-bg bottom left"></div>
            </div>
            <div class="col-md-6 col-xs-12 panel">
                <a class='linkBlock' href="<?php echo get_page_permalink("industry"); ?>">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-sm-12">
                        <div class="content-box">
                            <img src="<?php echo get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/industry-single.png"); ?>" alt=<?php _e("Industry 4.0"); ?> />
                            <h2 class="secondaryHomeHeader"><?php _e("Industry 4.0"); ?></h2>
                            <h3><?php _e("Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes", "default"); ?></h3>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </a>
                <div id='panelRight' class="panel-bg bottom right"></div>
            </div>
        </div>
    </div>
    <section class="container-fluid" id="motion-capture">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 px-5">
                    <figure>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/golf-motion-analysis.jpg" alt=<?php _e("STT systems Motion analysis"); ?>>
                    </figure>
                </div>
                <div class="col-lg-5">
                    <span><?php _e("STT: 20 Years creating"); ?></span>
                    <h2><?php _e("Motion Capture Systems"); ?></h2>
                    <p><?php _e("STT systems was created by a group of engineers in 1998 in San Sebastian, with the aim of devising high quality motion capture technology. We work on the creation of multiple motion analysis products with different objectives, such as clinical studies, sport researchers or biomechanics. These products include both motion capture software and hardware, creating ready to be used and complete motion analysis systems."); ?></p>
                    <p><?php _e("More specifically, most of our activity is focused on the development of 3d motion capture systems for sport and human studies. For example, we create advanced systems to facilitate running, cycling or golf motion analysis. In addition to all this, we also create image processing software and hardware for industrial purposes. We invite you to browse our website and discover all these products and services in more depth."); ?></p>
                    <a href=<?php _e("/motion-analysis/3d-optical-motion-capture/"); ?> class="btn btn-default"><?php _e("Suite 3DMA"); ?></a>
                </div>
            </div>
        </div>
    </section>
    <!--
    <section class="container-fluid" id="biomechanical">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12 bg-col">
                    <p><?php _e("Biomechanical analysis system"); ?></p>
                    <h2><?php _e("3DMA Suite"); ?></h2>
                    <span>3DMA</span>
                    <figure>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/systems-3dma-suite.jpg" alt="STT systems 3DMA">
                    </figure>
                </div>
                <div class="col-md-4 col-sm-12 col-md-offset-3 align-self-center">
                    <p><?php _e("Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat."); ?></p>
                    <p><?php _e("Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laore."); ?></p>
                    <a href="#" class="btn btn-default"><?php _e("Read More"); ?></a>
                </div>
            </div>
        </div>
    </section>
    -->
    <section class="container-fluid" id="industry">
        <div class="row justify-content-start">
            <div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-5 col-sm-12">
                <figure class="d-block d-lg-none">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/industry-bg.jpg" alt=<?php _e("STT systems 3DMA"); ?>>
                </figure>
                <span><?php _e("Industry 4.0"); ?></span>
                <h2><?php _e("The best solution for your company"); ?></h2>
                <p><?php _e("We carry out projects that help companies implement smart automation, monitoring and manufacturing processes. We put all our experience at your disposal to provide solutions that adapt to your company and your industrial environment."); ?></p>
                <a href=<?php _e("/industry/machine-vision/"); ?> class="btn btn-default"><?php _e("Read more"); ?></a>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 industry-bg"></div>
        </div>
    </section>
    <section id="call-to-action" class="container-fluid">
        <div id="particles-js"></div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                <span><?php _e("Get in touch now!"); ?></span>
                <span class="spanTakeStep"><?php _e("Take the step and exceed your sports limits."); ?></span>
                <a href=<?php _e("/contact-us/"); ?> class="btn btn-default"><?php _e("Contact"); ?></a>
            </div>
        </div>
    </section>
    <section class="container-fluid" id="trust">
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-sm-12 col-lg-10 text-center">
                    <span><?php _e("Your trust, our best reward"); ?></span>
                    <h2><?php _e("Main Customers"); ?></h2>
                    <div class="images">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/010-seat.png"  alt="Seat logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/020-vw.png"  alt="volkswagen logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/030-mercedes-benz.png"   alt="Mercedes benz logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/040-cie-automotive.png"  alt="Cie Automotive logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/050-nem.png" alt="Nem Logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/060-pasaban.png"  alt="Pasaban logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/070-tetrapak.png"  alt="Tetrapak logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/080-caf.png" alt="CAF logo - STT Systems">
                        <img class=" lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/090-becton-dickinson.png"  alt="Becton Dickinson Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/100-tiruña.png"  alt="tiruña logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/110-copreci.png"  alt="Copreci Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/120-pmg-polmetasa.png"  alt="Polmetasa Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/130-kyb.png"  alt="KyB logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/140-lau-nik.png"  alt="Lau nik logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/150-tajo.png"  alt="Tajo Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/160-soraluce.png"  alt="Soraluce Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/170-fnmt.png"  alt="FNMT Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/180-microdeco.png"  alt="Microdeco Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/190-altadis.png"  alt="Altadis Logo - STT Systems0">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/200-thyssenkrupp.png"  alt="Thyssenkrupp Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/210-trelleborg.png"  alt="Trelleborg Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/220-bsh.png"  alt="BSH Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/230-zanini.png"  alt="Zanini Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/240-tenneco.png"  alt="Tenneco Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/250-mondragon-assembly.png"  alt="Mondragon assembly Logo">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/260-eika.png"  alt="Eika Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/270-siemens-gamesa.png"  alt="Gamesa Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/290-gestamp.png"  alt="gestamp logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/300-iparlat.png"  alt="Iparlat Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/310-fagor-ederlan-tafalla.png"  alt="Fagor Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/320-kleannara.png"  alt="Kleannara Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/330-lanbi.png"  alt="Lanbi Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/340-lear.png"  alt="Lear logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/350-voith.png"  alt="Voith Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/360-maier.png"  alt="Maier Logo - STT Systems">
                        <img class=" ls-is-cached lazyloaded" src="https://www.stt-systems.com/wp-content/uploads/clients/industry-all/370-bilstein.png"  alt="Bilstein Logo - STT Systems">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid" id="accesories">
        <div class="row justify-content-end">
            <div class="col-lg-7 col-md-7 col-sm-12 accesories-bg"></div>
            <div class="col-lg-4 col-md-5 col-sm-12">
                <figure class="d-block d-lg-none">
                    <img src="/wp-content/uploads/motion-accesories.jpg" alt=<?php _e("Accesories analysis"); ?>>
                </figure>
                <span><?php _e("Our Store"); ?></span>
                <h2><?php _e("Accesories for motion analysis"); ?></h2>
                <p><?php _e("In our store you can find accessories for optical motion capture, such as reflective markers or Velcro bases."); ?></p>
                <a href="https://store.stt-systems.com/es/shop" class="btn btn-default"><?php _e("Visit Store"); ?></a>
            </div>
        </div>
    </section>
    <section class="container-fluid" id="home-noticias">
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-xs-12 text-center">
                    
                    <h2><?php _e("Latest news"); ?></h2>
                    <?php echo entradas_blog(); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script  src="<?php echo get_stylesheet_directory_uri(); ?>/js/particles.min.js"></script>
<script async>
    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 80,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 1,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "window",
            "events": {
                "onhover": {
                    "enable": false,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": false,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
    var count_particles, stats, update;
    stats = new Stats;
    stats.setMode(0);
    stats.domElement.style.position = 'absolute';
    stats.domElement.style.left = '0px';
    stats.domElement.style.top = '0px';
    document.body.appendChild(stats.domElement);
    count_particles = document.querySelector('.js-count-particles');
    update = function() {
        stats.begin();
        stats.end();
        if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
            count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
        }
        requestAnimationFrame(update);
    };
    requestAnimationFrame(update);;
</script>
<?php get_footer(); ?>