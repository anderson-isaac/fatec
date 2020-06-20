<!DOCTYPE html>

  <html lang="pt-br">
  <!--<![endif]-->
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->


    <title>Mural FATEC </title>
    <base href="http://localhost/fatec/"/>
    <!-- <base href="http://desenvolvimentomw.com.br/anderson/tests/"/> -->
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="./assets/js/vue.min.js"></script>
    <script src="./assets/js/axios.min.js"></script>
  </head>

  <body>

    <header class="load-me" data-src="components/header.html"></header>

    <section id="mural" class="page-section">
      <nav id="nav-component" class="nav">
        <button type="button" :class="tab" v-on:click="loadTab(0)">Vagas</button>
        <button type="button" :class="tab" v-on:click="loadTab(1)">Avisos</button>
      </nav>
      <div id="nav-area" class="container tall">

        <div id="mural-vagas" class="nav-area-item active">
          <div class="filters form-inline">
            <div class="custom-control custom-checkbox mr-3">
              <input type="checkbox" class="custom-control-input" id="vagas-favoritos" v-model="filtrarFavoritos">
              <label class="custom-control-label" for="vagas-favoritos"> Favoritos</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="vagas-candidaturas" v-model="filtrarCandidaturas">
              <label class="custom-control-label" for="vagas-candidaturas"> Candidaturas</label>
            </div>
          </div>
          <div class="vue-loading" v-if="loading">
            <i class="fa fa-spinner fa-spin"></i>
          </div>
          <div class="card mb-3" v-for="vaga in vagas" v-if="!loading">
            <div class="card-body">
              <ul class="pb-0">
                <li><b>Cargo</b> {{ vaga.cargo }}</li>                
                <li><b>Empresa</b> {{ vaga.empresa }}</li>
                <li>
                  <b>Tipo</b>
                  <span v-if="vaga.tipo == 0">Estágio</span>
                  <span v-if="vaga.tipo == 1">Emprego</span>                  
                </li>
                <li v-if="vaga.tipo == 0">
                  <b>Valor da Bolsa</b> {{ vaga.valor_da_bolsa }}
                </li>
                <li v-if="vaga.tipo == 1">
                  <b>Remuneracao</b> {{ vaga.remuneracao }}
                </li> 
                <li><b>Postado em</b> {{ vaga.postado }}</li>
              </ul>
            </div>
            <div class="btn-group">

              <!-- PÁGINA INTERNA -- START -->
              <a :href="`vaga.html?id=${vaga.id}`" class="btn btn-flat">
                <i class ="fa fa-plus"></i>
                Detalhes
              </a>
              <!-- PÁGINA INTERNA -- END -->

              <!-- FAVORITAR -- START -->
              <button type="button" class="btn btn-flat active" :data-id="vaga.id" v-if="vaga.favorito">
                <i class="fa fa-star"></i>
                Favorito
              </button>
              <button type="button" class="favoritar btn btn-flat" :data-id="vaga.id" v-else>
                <i class="fa fa-star-o"></i>
                Favoritar
              </button>
              <!-- FAVORITAR -- END -->

              <!-- Cadastrar à vaga -- START -->
              <button type="button" class="btn btn-flat active" v-if="vaga.candidato">
                <i class="fa fa-check-circle"></i>
                Concorrendo
              </button>
              <button type="button" class="candidatar btn btn-flat" :data-id="vaga.id" v-else>
                <i class="fa fa-circle-o"></i>
                Candidatar
              </button>
              <!-- Cadastrar à vaga -- END -->

            </div>
          </div>
          <div class="alert alert-danger" v-if="errored">
            <p><i class="fa fa-error"></i> Ocorreu um erro ao carregar as vagas, por favor, tente novamente mais tarde. </p>
          </div>

          <div class="mural-control text-center">
            <div class="load-more" v-if="carregarMais && !loading">
              <button type="button" class="btn btn-secondary btn-full" v-on:click="carregar">
                Carregar mais postagens
              </button>
            </div>
          </div>
        </div>

        <div id="mural-avisos" class="nav-area-item">
          <div class="filters form-inline">
            <div class="custom-control custom-checkbox mr-3">
              <input type="checkbox" class="custom-control-input" id="avisos-favoritos" v-model="filtrarFavoritos">
              <label class="custom-control-label" for="avisos-favoritos"> Favoritos</label>
            </div>
          </div>
          <div class="vue-loading" v-if="loading">
            <i class="fa fa-spinner fa-spin"></i>
          </div>
          <ul v-for="aviso in avisos" v-if="!loading">
            <li class="card">
              <a :href="`aviso.html?id=${ aviso.id }`" v-if="aviso.capa">
                <img class="card-img-top" :src="`${ aviso.capa }`" alt="">
              </a>
              <div class="card-body">
                <h5 class="card-title">
                  <div class="author">
                    <a :href="`autor.html?id=${ aviso.autor }`">
                      <img :src="`${ aviso.autor_foto }`" alt="" class="profile-photo">
                    </a>
                    <small>
                      <a :href="`autor.html?id=${aviso.autor}`">
                        {{ aviso.autor_nome }}
                      </a>
                    </small>
                  </div>
                  <a :href="`aviso.html?id=${ aviso.id }`">
                  {{ aviso.titulo }}
                  </a>
                </h5>
                <p class="card-text">
                  {{ aviso.resumo }}
                </p>
                <p class="card-text"><small class="text-muted">Postado em {{ aviso.postado }}</small></p>
              </div>
              <div class="btn-group">

                <a :href="`aviso.html?id=${ aviso.id }`" class="btn btn-flat">
                  <i class="fa fa-search"></i> Ver conteúdo completo
                </a>

                <!-- FAVORITAR -- START -->
                <button type="button" class="btn btn-flat active" v-if="aviso.favorito">
                  <i class="fa fa-star"></i>
                  Favorito
                </button>
                <button type="button" class="favoritar btn btn-flat" :data-id="aviso.id" v-else>
                  <i class="fa fa-star-o"></i>
                  Favoritar
                </button>
                <!-- FAVORITAR -- END -->

              </div>
            </li>
          </ul>
          <div class="mural-control text-center">
            <div class="load-more" v-if="carregarMais && !loading">
              <button type="button" class="btn btn-secondary btn-full" v-on:click="carregar">
                Carregar mais postagens
              </button>
            </div>
          </div>
        </div>

      </div>
    </section>

    <footer class="load-me" data-src="components/footer.html"></footer>

    <script src="./assets/js/jquery.3.2.1.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.mask.js"></script>
    <script src="./assets/js/sweetalert.min.js"></script>
    <script src="./assets/js/main.js"></script>


    <script>

      var tab = getUrlParameter('tab') ? getUrlParameter('tab') : 0,                
                tabsLoaded = [];

      var axiosConfig = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        }
      };

      /* VUE :: VAGAS APP */
      var vagasURL = base + 'server/vagas.php';
      var app = [];
      app[0] = new Vue({
        el: '#mural-vagas',
        data () {
          return {
            first: true,
            info: null,
            vagas: null,
            loading: true,
            errored: false,
            slice: 0,
            filtrarFavoritos: false,
            filtrarCandidaturas: false,
            carregarMais: true,
            once : true
          }
        },
        methods: {
          carregar: function() {
            let scrollHeight = $('#mural-vagas ul').length ? $('#mural-vagas .mural-control').position().top : 0;            
            $('#mural-vagas')
              .find('.load-more .btn')
              .html("<i class='fa fa-refresh fa-spin'></i>")
            axios
            .post(vagasURL, {
              slice: this.slice,
              filtrarFavoritos: this.filtrarFavoritos,
              filtrarCandidaturas: this.filtrarCandidaturas
            }, axiosConfig)
            .then(response => {
              console.log(response.data.vagas);
              this.info = response.data.vagas;
              if (this.info.length < 6) {
                console.log(1);
                this.carregarMais = false;
              } else {
                console.log(2);
                this.carregarMais = true;
              }
              if (this.slice > 0) {
                console.log(3);
                this.info.forEach(element => {
                  this.vagas.push(element);
                });
              } else {
                this.vagas = this.info;
              }
              this.errored = false;
            })
            .catch(error => {
              console.log(error)
              this.errored = true
            })
            .finally(() => {
              this.loading = false;
              if (this.slice > 0) {
                $('#mural-vagas')
                  .find('.load-more .btn')
                  .html('Carregar mais postagens');
                  let plus = 0;
                  if (!this.once) {
                    plus = 40;
                  }
                $('html, body').animate({
                  scrollTop : scrollHeight + plus
                }, 500);
              }
              this.slice += 6;
              this.once = false;
            })
          }
        },
        watch: {
          filtrarCandidaturas: function() {
            this.loading = true;
            this.slice = 0;
            this.carregar();
          },
          filtrarFavoritos: function() {
            this.loading = true;
            this.slice = 0;
            this.carregar();
          }
        }
      });

      /* VUE :: AVISOS APP */
      var avisosURL = base + 'server/avisos.php';
      app[1] = new Vue({
        el: '#mural-avisos',
        data () {
          return {
            info: null,
            avisos: [],
            loading: true,
            errored: false,
            slice: 0,
            filtrarFavoritos: false,
            firstLoad: true,
            carregarMais: true,
            once : true
          }
        },
        methods: {
          carregar: function() {
            let scrollHeight = $('#mural-avisos ul').length ? $('#mural-avisos .mural-control').position().top : 0;
            $('#mural-avisos')
              .find('.load-more .btn')
              .html("<i class='fa fa-refresh fa-spin'></i>")
            axios
            .post(avisosURL, {
              slice: this.slice,
              filtrarFavoritos: this.filtrarFavoritos
            }, axiosConfig)
            .then(response => {
              this.info = response.data.avisos;
              if (this.info.length < 6) {
                this.carregarMais = false;
              } else {
                this.carregarMais = true;
              }
              if (this.slice > 0) {
                this.info.forEach(element => {
                  this.avisos.push(element);
                });
              } else {
                this.avisos = this.info;
              }
              this.errored = false;
            })
            .catch(error => {
              console.log(error)
              this.errored = true;
            })
            .finally(() => {
              this.loading = false;
              if (this.slice > 0) {
                $('#mural-avisos')
                  .find('.load-more .btn')
                  .html('Carregar mais postagens');
                }
                let plus = 0;                
                if (!this.once) {
                  plus = 40;
                }
                $('html, body').animate({
                  scrollTop : scrollHeight + plus
                }, 500);
                this.slice += 6;
                this.once = false;
              
            })
          }
        },
        watch: {
          filtrarFavoritos: function() {
            this.loading = true;
            this.slice = 0;
            this.carregar();
          }
        }
      });

      /* VUE :: NAV COMPONENT */
      var nav = new Vue({
      el: '#nav-component',
      data() {
        return {
          tab: tab
        }
      },
      methods: {
        loadTab : function(t) {
          let _el = $('#nav-component button').eq(t);
          let _index = _el.index();                 

          if (_el.hasClass('active')) return false;

          _el.siblings().removeClass('active');
          _el.addClass('active');
          $('#nav-area .nav-area-item').removeClass('active');
          $('#nav-area .nav-area-item').eq(t).addClass('active');

          if (!_el.hasClass('app-loaded')) {
            app[_index].carregar();
            _el.addClass('app-loaded');
          }

        }
      },
      mounted() {
       
        this.loadTab(tab);

      }
    });


    </script>

  </body>
</html>