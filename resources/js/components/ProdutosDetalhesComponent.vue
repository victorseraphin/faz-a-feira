<template>
  <div id="app">
    <menu-component></menu-component>

    <b-container class="bv-example-row">
      <nav aria-label="breadcrumb" style="margin-top: 10px">
        <b-breadcrumb :items="items"></b-breadcrumb>
      </nav>
      <b-list-group flush class="list my--3">
        <b-list-group-item
          class="list-group-item px-0"
          v-for="item in products.data"
          :key="item.id"
        >
          <b-row align-v="center">
            <b-col md="auto" style="margin-left: 20px">
              <!-- Avatar -->
              <a href="javascript:;" class="avatar">
                <b-img
                  alt="Image placeholder"
                  :src="item.photo"
                  width="500px"
                />
              </a>
            </b-col>
            <b-col class="ml--2">
              <h4 class="mb-0">
                {{ item.nome }}
              </h4>
              <p>
                <br />
                <b-icon
                  icon="suit-heart-fill"
                  color="red"
                  scale="1.10"
                  shift-v="1.10"
                  aria-hidden="true"
                  align="left"
                >
                </b-icon>
                {{ item.curtidas }}
              </p>
              
                <h6 class="mb-0">
                  Preço:
                  R$ {{ item.preco }}
                </h6>
              

              <p class="mb-0">
                <br />
                Descrição:
                {{ item.descricao }}
              </p>
            </b-col>
          </b-row>
        </b-list-group-item>
      </b-list-group>
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
          text: "Detalhes do Produto",
          active: true,
        },
      ],
      id_produto: this.$route.params.id,
      products: [],
    };
  },
  mounted() {
    axios
      .get(
        "api/produtos_detalhes/" + this.id_produto,
        {
          headers: {
            Authorization: "Bearer " + store.state.dadoToken,
          },
        }
      )
      .then((response) => {
        console.log(response);
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
  methods: {},
};
</script>
