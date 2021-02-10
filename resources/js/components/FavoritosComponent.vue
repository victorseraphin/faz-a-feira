<template>
  <div id="app">
    <menu-component></menu-component>

    <b-container class="bv-example-row">
      <nav aria-label="breadcrumb" style="margin-top: 10px">
        <b-breadcrumb :items="items"></b-breadcrumb>
      </nav>

      <b-list-group flush class="list my--3" style="margin-bottom:20px">
        <b-list-group-item
          class="list-group-item px-0"
          v-for="item in products.data"
          :key="item.id"
        >
          <b-row align-v="center">
            <b-col md="auto" style="margin-left: 20px">
              <b-navbar-nav>
                <b-nav-item
                  href="#"
                  :to="{ name: 'produtos-detalhes', params: { id: item.produto_id } }"
                  ><b-img
                    alt="Image placeholder"
                    :src="item.photo"
                    width="100px"
                  />
                </b-nav-item>
              </b-navbar-nav>
            </b-col>
            <b-col class="ml--2">
              <h4 class="mb-0">
                {{ item.nome }}
              </h4>
              <p class="mb-0">
                {{ item.descricao }}
              </p>
              <br />
              <h6 class="mb-0"> R$ {{ item.preco }} </h6>
            </b-col>
            <b-col md="auto">
              <b-button
                size="sm"
                variant="outline-danger"
                style="margin-right: 20px"
                v-on:click="remover(item.id)"
                >Remover</b-button
              >
            </b-col>
          </b-row>
        </b-list-group-item>
      </b-list-group>
      <b-pagination
        v-on:change="onPageChange"
        v-model="products.current_page"
        pills
        :total-rows="products.total"
        :per-page="products.per_page"
        align="center"
      >
      </b-pagination>
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
          href: "/",
        },
        {
          text: "Meus Favoritos",
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
      .get("api/desejos/" + this.dados_user.id, {
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
    remover(item_id) {
      axios
        .get("api/desejos/deletar/" + this.dados_user.id + "/" + item_id, {
          headers: {
            Authorization: "Bearer " + store.state.dadoToken,
          },
        })
        .then((response) => {
          this.$router.go(0)
        })
        .catch((error) => {
          this.loginError = true;
          console.log(error);
        });
    },
    onPageChange(pageNum) {
      axios
        .get("api/desejos/" + this.dados_user.id + "/" + "?page=" + pageNum, {
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
  },
};
</script>
