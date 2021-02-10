<template>
  <div id="app">
    <menu-component></menu-component>

    <b-container class="bv-example-row">
      <nav aria-label="breadcrumb" style="margin-top: 10px">
        <b-breadcrumb :items="items"></b-breadcrumb>
      </nav>
      <div class="products">
        <div class="row">
          <div
            class="col-md-3"
            v-for="(item, index) in products.data"
            :key="index"
            style="margin-bottom: 10px"
          >
            <div class="card">
              <div
                class="card-body"
                style="margin-top: -10px; margin-bottom: -30px"
              >
                <b-navbar-nav class="ml-auto">
                  <b-nav-item v-on:click="favoritar(item.id)">
                    <b-icon
                      icon="suit-heart"
                      color="gray"
                      scale="1.25"
                      shift-v="1.25"
                      aria-hidden="true"
                      align="left"
                    ></b-icon>
                  </b-nav-item>
                </b-navbar-nav>
              </div>
              <b-navbar-nav>
                <b-nav-item
                  href="#"
                  :to="{ name: 'produtos-detalhes', params: { id: item.id } }"
                  ><b-img
                    :alt="item.nome"
                    :src="item.photo"
                    class="card-img-top"
                  />
                </b-nav-item>
              </b-navbar-nav>
              <div class="card-body">
                <h4 class="card-title">{{ item.nome }}</h4>
                <div class="card-text">{{ item.preco }}</div>
              </div>
            </div>
          </div>
        </div>
        <b-pagination
          v-on:change="onPageChange"
          v-model="products.current_page"
          pills
          :total-rows="products.total"
          :per-page="products.per_page"
          align="center"
        >
        </b-pagination>
      </div>
    </b-container>
  </div>
</template>

<script>
import MenuComponent from "./MenuComponent.vue";
import store from "../store";
export default {
  components: { MenuComponent },
  data() {
    return {
      items: [
        {
          text: "Home",
          active: true,
        },
        {
          text: "Produtos",
          active: true,
        },
      ],
      products: [],
      loading: false,
      dados_user: JSON.parse(store.state.dadosUser),
    };
  },
  mounted() {
    axios
      .get("api/produtos", {
        headers: {
          Authorization: "Bearer " + store.state.dadoToken,
        },
      })
      .then((response) => {
        this.loading = false;
        this.products = response.data;
      })
      .catch((error) => {
        console.log(error);
        errorToaster(
          "The server encountered an unexpected condition.",
          "Internal Error 500"
        );
      });
    console.log("Component mounted.");
  },
  methods: {
    onPageChange(pageNum) {
      axios
        .get("api/produtos?page=" + pageNum, {
        headers: {
          Authorization: "Bearer " + store.state.dadoToken,
        },
      })
        .then((response) => {
          this.loading = false;
          this.products = response.data;
        })
        .catch((error) => {
          console.log(error);
          errorToaster(
            "The server encountered an unexpected condition.",
            "Internal Error 500"
          );
        });
    },
    favoritar(produto_id) {
      axios
        .post(
          "/api/desejos/salvar",
          {
            produto_id: produto_id,
            user_id: this.dados_user.id,
          },
          {
            headers: {
              Authorization: "Bearer " + store.state.dadoToken,
            },
          }
        )
        .then((response) => {        
          this.$router.go(0)
        })
        .catch((error) => {
          this.loginError = true;
          console.log(error);
        });
    },
  },
};
</script>
