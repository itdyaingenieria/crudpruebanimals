<template>
  <div class="card">
    <div class="card-body">
      <!-- button atas -->
      <template>
        <v-toolbar flat>
          <v-toolbar-title>Datos Corrales</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click.prevent="crearRoute()" dark class="mb-2">Crear Corral</v-btn>
        </v-toolbar>
      </template>
      <v-card-title>
        <v-spacer></v-spacer>

        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Buscar"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      
      <v-data-table
        :headers="headers"
        :items="data"
        :search="search"
        :items-per-page="10"
        class="elevation-2"
      >
        <template v-slot:item.action="{ item }">

          <v-icon @click="editItem(item)">mdi-pencil</v-icon>
          <v-icon color="error" @click="deleteItem(item)">mdi-delete</v-icon>
          <v-icon @click="addItem(item)">mdi-folder-move</v-icon>
        </template>
        <!-- end -->
      </v-data-table>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      headers: [
        {
          text: "Nombre",
          value: "nombre",
        },
        {
          text: "Maximo",
          value: "maximo",
        },
               {
          text: "Promedio Edad",
          value: "promedioedad",
        },
        {
          text: "Actions",
          value: "action",
          sortable: false,
          align: "center",
        },
      ],
      data: [],
      search: "",
      modelDelete: false,
    };
  },
  methods: {
    GetData() {
      axios
        .get("/api/corrales")
        .then((response) => {
          this.data = response.data;
          console.log(this.data);
        })
        .catch((eror) => {
          console.log(eror);
        });
    },
    crearRoute() {
      this.$router.push("/corrales/create");
    },
    addItem(item) {
      this.$router.push("/corrales/addanimals/" + item.id);
    },
    deleteItem(item) {
      console.log(item.id);
      Swal.fire({
        title: "Desea ELiminar Registro ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete("/api/corrales/" + item.id).then((response) => {
            console.log("berhasil");
            const idx = this.data.indexOf(item);
            this.data.splice(idx, 1);

            Swal.fire(
              "Eliminado!",
              "EL Registro se elimino Correctamente!!.",
              "success"
            );
          });
        }
      });
    },
    editItem(item) {
      this.$router.push("/corrales/" + item.id);
    },
  },

  mounted() {
    this.GetData();
  },
};
</script>
