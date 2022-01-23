<template>
  <div class="card">
    <div class="card-body">
      <!-- button atas -->
      <template>
        <v-toolbar flat>
          <v-toolbar-title>Animales Prueba Tecnica</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click.prevent="createRoute()" dark class="mb-2">Crear Animal</v-btn>
        </v-toolbar>
      </template>
      <!-- end button atas -->
      <!-- header -->
      <v-card-title>
        <v-spacer></v-spacer>
        <!-- search engine -->
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
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
        <!-- header table -->
        <template v-slot:item.action="{ item }">
          <v-icon @click="editItem(item)">mdi-pencil</v-icon>
          <v-icon color="error" @click="deleteItem(item)">mdi-delete</v-icon>
        </template>
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
          text: "Id", // nama header
          value: "id", //  value dari database
        },
        {
          text: "Tipo",
          value: "tipo",
        },
        {
          text: "Peligrosidad",
          value: "peligrosidad",
        },
        {
          text: "Edad",
          value: "edad",
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
        .get("/api/animales")
        .then((response) => {
          this.data = response.data;
          console.log(response.data); // data
        })
        .catch((eror) => {
          console.log(eror);
        });
    },
    createRoute() {
      this.$router.push("/animales/create");
    },
    deleteItem(item) {
      // item = collection or {}
      console.log(item.id);
      Swal.fire({
        title: "Desea Eliminar ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete("/api/animales/" + item.id).then((response) => {
            const idx = this.data.indexOf(item);
            this.data.splice(idx, 1);

            Swal.fire("Eliminado!", "El registro se Elimino.", "success");
          });
        }
      });
    },
    editItem(item) {
      this.$router.push("/animales/" + item.id);
    },
  },

  mounted() {
    this.GetData();
  },
};
</script>
