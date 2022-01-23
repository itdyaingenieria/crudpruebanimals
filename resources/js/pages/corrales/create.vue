<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form @submit.prevent="StoreForm()" action="/corrales" method="POST">
            <div class="form-group">
              <label for="basicInput">Nombre</label>
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

            <router-link to="/siswa" class="btn btn-danger">Cancelar</router-link>
            <button type="submit" class="btn btn-success">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
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
    StoreForm() {
      console.log(this.form);
      axios
        .post("/api/corrales", this.form)
        .then((response) => {
          if (response.data.status) {
            // console.log(response.data.messege);
            this.$noty.success(response.data.messege);
            this.$router.push({
              name: "corrales",
            });
          }
        })
        .catch((error) => {
          // console.log(error.response.data.errors);
          this.error = error.response.data.errors;
        });
    },
  },
};
</script>
