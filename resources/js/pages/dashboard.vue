<template>
  <div class="row">
    <div id="example-1">
      <v-btn v-on:click="generateReport()">Imprimir Reporte</v-btn>
    </div>
    <div class="col-12 col-md-3">
      <div class="card card-statistic">
        <div class="card-body p-0">
          <div class="d-flex flex-column">
            <div class="px-3 py-3 d-flex justify-content-between">
              <h3 class="card-title">
                <i data-feather="user" style="width: 30px; height: 30px"></i>
                Animales
              </h3>
            </div>
            <div class="card-right ml-3 mb-4">
              <p>{{ data.animal }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3">
      <div class="card card-statistic">
        <div class="card-body p-0">
          <div class="d-flex flex-column">
            <div class="px-3 py-3 d-flex justify-content-between">
              <h3 class="card-title">
                <i data-feather="figma" style="width: 30px; height: 30px"></i>
                Corrales
              </h3>
            </div>
            <div class="card-right ml-3 mb-4">
              <p>{{ data.corral }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <barchart v-if="loaded" :chartdata="chartData" :options="options" />

    <div>
      <VueHtml2pdf
        :show-layout="false"
        :float-layout="true"
        :enable-download="true"
        :preview-modal="true"
        :paginate-elements-by-height="1400"
        filename="Reportes Corrales"
        :pdf-quality="2"
        :manual-pagination="false"
        pdf-format="a4"
        pdf-orientation="landscape"
        pdf-content-width="800px"
        ref="html2Pdf"
      >
        <section slot="pdf-content">
          <!-- PDF Content Here -->
          <h1 class="title-header">Reporte de Corrales</h1>
          <h1 class="title-header">{{datareport.nombre}}</h1>

          <table class="w-full table-auto">
            <thead class="rounded-lg">
              <tr>
                <th class="p-3">id</th>
                <th class="p-3">Corral</th>
                <th class="p-3">Tipo</th>
                <th class="p-3">Peligrosidad</th>
                <th class="p-3">Edad</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in datareport" v-bind:key="user.id_pivot">
                <td class="p-3 text-center border">{{ user.id }}</td>
                <td class="p-3 border">{{ user.nombre }}</td>
                <td class="p-3 border">{{ user.tipo }}</td>
                <td class="p-3 border">{{ user.peligrosidad }}</td>
                <td class="p-3 border">{{ user.edad }}</td>
              </tr>
            </tbody>
          </table>
        </section>
      </VueHtml2pdf>
    </div>
  </div>
</template>
<script>
import barchart from "../components/Render.vue";
import VueHtml2pdf from "vue-html2pdf";

export default {
  name: "LineChartContainer",
  components: { barchart, VueHtml2pdf },
  data() {
    return {
      loaded: false,
      chartdata: null,
      data: {
        animal: "0",
        corral: "0",
      },
      datareport: {},
      chartData: {
        labels: [],
        datasets: [
          {
            label: "Total Animales x Corral: ",
            borderWidth: 1,
            pointBorderColor: "#2554FF",
            data: [],
          },
        ],
      },
      options: {},
    };
  },
  methods: {
    getAllData() {
      axios.get("/api/dashboard").then((response) => {
        this.data = {
          animal: response.data.animal,
          corral: response.data.corral,
        };
      });
      this.imprimeReporte();
    },
    generateReport() {
      this.$refs.html2Pdf.generatePdf();
    },
    imprimeReporte() {
      axios.post("/api/corrales/imprimir").then((response) => {
        this.datareport = response.data;
        console.log(this.datareport);
      });
    },
  },
  async mounted() {
    this.getAllData();
    this.loaded = false;
    try {
      axios.post("/api/corrales/contaranimals", this.data).then((response) => {
        //  console.log(response.data.map((i) => i.nombre));
        // Get all the labels from the response
        this.chartData.labels = response.data.map((i) => i.nombre);
        // Get all the data from the response
        this.chartData.datasets[0].data = response.data.map((i) => i.totales);
        this.loaded = true;
      });
    } catch (e) {
      console.error(e);
    }
  },
};
</script>
