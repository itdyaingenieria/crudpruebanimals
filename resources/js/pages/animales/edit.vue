<template>
    <div class="card">
        <!-- <div class="card-header">
                            <h4 class="card-title">Basic Inputs</h4>
                        </div> -->

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form @submit.prevent="StoreForm()" action="/siswa" method="POST">
                        <div class="form-group">
                            <label for="helpInputTop">Tipo</label>
                            <input type="text" class="form-control" id="helpInputTop" placeholder="Tipo de Animal"
                                v-model="form.tipo" v-bind:class="{ 'is-invalid': erorr.tipo }">
                            <div v-if="erorr.tipo" class="invalid-feedback">
                                {{ erorr.tipo[0]  }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="helperText">Peligrosidad</label>
                            <select class="form-control" v-bind:class="{ 'is-invalid': erorr.peligrosidad }" name="" id=""
                                v-model="form.peligrosidad">
                                <option value="">-- Escoja una Opcion--</option>
                                <option value="ALTA">ALTA</option>
                                <option value="MEDIA">MEDIA</option>
                                <option value="BAJA">BAJA</option>
                            </select>
                            <div v-if="erorr.peligrosidad" class="invalid-feedback">
                                {{ erorr.peligrosidad[0]  }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="helperText">Edad</label>
                            <input type="number" id="helperText" class="form-control" placeholder="Edad"
                                v-model="form.edad" v-bind:class="{ 'is-invalid': erorr.edad }">
                            <div v-if="erorr.edad" class="invalid-feedback">
                                {{ erorr.edad[0]  }}
                            </div>
                            </p>
                        </div>

 
                        <router-link to="/animales" class="btn btn-danger">Cancelar</router-link>
                        <button type="submit" class="btn btn-success">Actualizar</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props : ['id'],
        data() {
            return {
                form: {
                    tipo: ' ',
                    peligrosidad: ' ',
                    edad: ' ',
                },
                option: [],
                erorr: [],
                data: {}
            }
        },
        methods: {
            // getValueOption() {
            //     axios.post('/api/option/value', this.data).then((response) => {
            //         this.option = response.data;
            //         // console.log(this.option);
            //     });
            // },
            getData() {
                axios.get('/api/animales/' + this.id + '/edit').then((response) => {
                    this.form = { // add data to v-model="form.*" 
                        tipo: response.data.tipo,
                        peligrosidad: response.data.peligrosidad,
                        edad: response.data.edad,
                    }
                });
            },
            
            StoreForm() {
                axios.put('/api/animales/'+ this.id, this.form).then((response) => {
                    if (response.data.status) {
                        // console.log(response.data.messege);
                        this.$noty.success(response.data.messege);
                        this.$router.push({
                            name: 'animales',
                        });
                    }
                }).catch((erorr) => {
                    // console.log(erorr.response.data.errors);
                    this.erorr = erorr.response.data.errors
                })
            }
        },
        mounted() {
            //this.getValueOption(),
            this.getData()
        },
    }

</script>
