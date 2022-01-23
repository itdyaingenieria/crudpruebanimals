<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form @submit.prevent="StoreForm()" action="/corrales" method="POST">
            <div class="form-group">
              <label for="basicInput">nombre</label>
              <input
                type="text"
                class="form-control"
                id="basicInput"
                placeholder="Masukan nombre"
                v-model="form.nombre"
                v-bind:class="{ 'is-invalid': error.nombre }"
              />
              <div v-if="error.nombre" class="invalid-feedback">{{ error.nombre[0] }}</div>
            </div>

            <div class="form-group">
              <label for="helpInputTop">maximo</label>
              <input
                type="text"
                class="form-control"
                id="helpInputTop"
                placeholder="Masukan maximo"
                v-model="form.maximo"
                v-bind:class="{ 'is-invalid': error.maximo }"
              />
              <div v-if="error.maximo" class="invalid-feedback">{{ error.maximo[0] }}</div>
            </div>

            <router-link to="/corrales" class="btn btn-danger">Cancelar</router-link>
            <button type="submit" class="btn btn-success">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id"],
  data() {
    return {
      form: {
        nombre: " ",
        maximo: " ",
      },
      option: [],
      error: [],
      data: {},
    };
  },
  methods: {
    getData() {
      axios.get("/api/corrales/" + this.id + "/edit").then((response) => {
          console.log(response.data);
        this.form = {
          nombre: response.data.nombre,
          maximo: response.data.maximo,
        };
      });
    },
    StoreForm() {
      console.log(this.form);
      axios
        .put("/api/corrales/" + this.id, this.form)
        .then((response) => {
          if (response.data.status) {
            // console.log(response.data.messege);
            this.$noty.success(response.data.messege);
            this.$router.push({
              name: "kelas",
            });
          }
        })
        .catch((error) => {
          // console.log(error.response.data.errors);
          this.error = error.response.data.errors;
        });
    },
  },
  mounted() {
    this.getData();
  },
};
</script>
