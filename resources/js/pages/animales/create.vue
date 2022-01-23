<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form @submit.prevent="StoreForm()" action="/animales" method="POST">
            <div class="form-group">
              <label for="helpInputTop">Tipo</label>
              <input
                type="text"
                class="form-control"
                id="helpInputTop"
                placeholder="Tipo de Animal"
                v-model="form.tipo"
                v-bind:class="{ 'is-invalid': error.tipo }"
              />
              <div v-if="error.tipo" class="invalid-feedback">{{ error.tipo[0] }}</div>
            </div>

            <div class="form-group">
              <label for="helperText">Peligrosidad</label>
              <select
                class="form-control"
                v-bind:class="{ 'is-invalid': error.peligrosidad }"
                name
                id
                v-model="form.peligrosidad"
              >
                <option value>--Escoja Una Opcion --</option>
                <option value="ALTA">ALTA</option>
                <option value="MEDIA">MEDIA</option>
                <option value="BAJA">BAJA</option>
              </select>
              <div v-if="error.peligrosidad" class="invalid-feedback">{{ error.peligrosidad[0] }}</div>
            </div>

            <div class="form-group">
              <label for="helperText">Edad</label>
              <input
                type="number"
                id="helperText"
                class="form-control"
                placeholder="Edad de Animal"
                v-model="form.edad"
                v-bind:class="{ 'is-invalid': error.edad }"
              />
              <div v-if="error.edad" class="invalid-feedback">{{ error.edad[0] }}</div>
            </div>
            <router-link to="/animales" class="btn btn-danger">Cancelar</router-link>
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
        tipo: " ",
        peligrosidad: " ",
        edad: " ",
      },
      option: [],
      error: [],
      data: {},
    };
  },
  methods: {
    // getValueOption() {
    //   axios.post("/api/option/value", this.data).then((response) => {
    //     this.option = response.data;
    //     console.log(this.option);
    //   });
    // },
    StoreForm() {
      axios
        .post("/api/animales", this.form)
        .then((response) => {
          if (response.data.status) {
            // console.log(response.data.messege);
            this.$noty.success(response.data.messege);
            this.$router.push({
              name: "animales",
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
    //this.getValueOption();
  },
};
</script>
