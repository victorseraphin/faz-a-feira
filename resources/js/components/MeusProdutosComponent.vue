<template>
  <div id="app">
    <menu-component></menu-component>

    <b-container class="bv-example-row">
      <nav aria-label="breadcrumb" style="margin-top: 10px">
        <b-breadcrumb :items="items"></b-breadcrumb>
      </nav>
      <b-col md="auto" style="margin-bottom: 20px">
        <b-button
          size="sm"
          variant="success"
          style="margin-right: 20px"
          @click="novoAnuncio"
          >Crir anúncio</b-button
        >
      </b-col>
      <b-list-group flush class="list my--3" style="margin-bottom: 20px">
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
                  :to="{ name: 'produtos-detalhes', params: { id: item.id } }"
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
              <h6 class="mb-0">R$ {{ item.preco }}</h6>
            </b-col>
            <b-col md="auto">
              <b-button
                size="sm"
                variant="outline-primary"
                style="width: 107px"
                @click="editarAnuncio(item)"
                >Editar anúncio</b-button
              ><br />
              <b-button
                size="sm"
                variant="outline-danger"
                style="margin-right: 20px; margin-top: 10px"
                v-on:click="remover(item.id)"
                >Deletar anúncio</b-button
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

    <!-- Modal -->
    <div
      class="modal fade"
      id="formAnuncio"
      tabindex="-1"
      role="dialog"
      aria-labelledby="formAnuncio"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Formulário Produtos</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editmode ? updateProduct() : createProduct()">
            <div class="modal-body">
              <div class="form-group">
                <label>Nome</label>
                <input
                  v-model="form.nome"
                  type="text"
                  name="nome"
                  class="form-control"
                />
                <has-error :form="form" field="nome"></has-error>
              </div>
              <div class="form-group">
                <label>Descrição</label>
                <input
                  v-model="form.descricao"
                  type="text"
                  name="descricao"
                  class="form-control"
                />
                <has-error :form="form" field="descricao"></has-error>
              </div>
              <div class="form-group">
                <label>Preço</label>
                <input
                  v-model="form.preco"
                  type="text"
                  name="preco"
                  class="form-control"
                />
                <has-error :form="form" field="preco"></has-error>
              </div>
              <div class="form-group">
                <label>Link Imagem</label>
                <input
                  v-model="form.photo"
                  type="text"
                  name="photo"
                  class="form-control"
                />
                <has-error :form="form" field="photo"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Fechar
              </button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
          text: "Meus Produtos",
          active: true,
        },
      ],
      editmode: false,
      form: new Form({
        id: "",
        nome: "",
        descricao: "",
        preco: "",
        photo: "",
      }),
      products: [],
      loading: false,
      dados_user: JSON.parse(store.state.dadosUser),
    };
  },
  mounted() {
    axios
      .get("api/produtos/" + this.dados_user.id, {
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
      Swal.fire({
        title: "Você tem certeza?",
        text: "Você não poderá reverter isso!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Nao, cancelar!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .get("api/produtos/deletar/" + this.dados_user.id + "/" + item_id, {
              headers: {
                Authorization: "Bearer " + store.state.dadoToken,
              },
            })
            .then(() => {
              Swal.fire("Deleted!", "Seu arquivo foi excluído.", "success");
              this.$router.go(0);
            })
            .catch((data) => {
              Swal.fire("Failed!", data.message, "warning");
            });
        }
      });
    },
    onPageChange(pageNum) {
      axios
        .get("api/produtos/" + this.dados_user.id + "/" + "?page=" + pageNum, {
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
          this.$Progress.failed();
          errorToaster(
            "The server encountered an unexpected condition.",
            "Internal Error 500"
          );
        });
    },
    novoAnuncio() {
      this.editmode = false;
      this.form.reset();
      $("#formAnuncio").modal("show");
    },
    createProduct() {
      this.$Progress.start();
      this.form
        .post("api/produtos/salvar/" + this.dados_user.id, {
          headers: {
            Authorization: "Bearer " + store.state.dadoToken,
          },
        })
        .then((data) => {
          $("#formAnuncio").modal("hide");

          Toast.fire({
            icon: "success",
            title: data.data.message,
          });
          this.$Progress.finish();
          this.$router.go(0);
        })
        .catch((error) => {
          this.$Progress.failed();
          Toast.fire({
            icon: "error",
            title: "Some error occured! Please try again",
          });
        });
    },
    editarAnuncio(product) {
      this.editmode = true;
      this.form.reset();
      $("#formAnuncio").modal("show");
      this.form.fill(product);
    },
    updateProduct() {
      this.$Progress.start();
      this.form
        .post(
          "api/produtos/atualizar/" + this.dados_user.id + "/" + this.form.id,
          {
            headers: {
              Authorization: "Bearer " + store.state.dadoToken,
            },
          }
        )
        .then((response) => {
          // success
          $("#formAnuncio").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          this.$router.go(0);
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
  },
};
</script>
