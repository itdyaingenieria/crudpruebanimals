<template>
	<div class="card">
		<div class="card-body">
			<v-row>
				<v-col cols="12" sm="6">
					<div class="form-group">
						<label for="basicInput">Nombre</label>
						<input
							type="text"
							class="form-control"
							id="basicInput"
							placeholder=" nombre"
							v-model="form.nombre"
							v-bind:class="{ 'is-invalid': error.nombre }"
							disabled
						/>
					</div>
				</v-col>
				<v-col cols="12" sm="6">
					<div class="form-group">
						<label for="helpInputTop">maximo</label>
						<input
							type="text"
							class="form-control"
							id="helpInputTop"
							placeholder=" maximo"
							v-model="form.maximo"
							v-bind:class="{ 'is-invalid': error.maximo }"
							disabled
						/>
					</div>
				</v-col>
			</v-row>
			<form @submit.prevent="StoreForm()" action="/corrales/asing_animals" method="POST">
				<v-row>
					<v-col cols="12" sm="6">
						<div class="form-group">
							<label for="helperText">Tipo Animal</label>
							<select
								class="form-control"
								v-bind:class="{ 'is-invalid': error.tipo }"
								name
								id
								v-model="formAsignar.tipo"
							>
								<option value>-- Escoja una Opcion --</option>
								<option
									v-for="options in option"
									:key="options.id"
									v-bind:value="options.id"
								>{{ options.tipo+' '+options.peligrosidad }}</option>
							</select>
							<div v-if="error.tipo" class="invalid-feedback">{{ error.tipo[0] }}</div>
						</div>
					</v-col>

					<v-col cols="12" sm="6">
						<div class="form-group">
							<label for="helpInputTop">Cantidad</label>
							<input
								type="number"
								class="form-control"
								id="helpInputTop"
								placeholder="Cantidad"
								v-model="formAsignar.cantidad"
								v-bind:class="{ 'is-invalid': error.cantidad }"
							/>
							<div v-if="error.cantidad" class="invalid-feedback">{{ error.cantidad[0] }}</div>
						</div>
					</v-col>
				</v-row>

				<router-link to="/corrales" class="btn btn-danger">Cancelar</router-link>
				<button type="submit" class="btn btn-success">Asinar Animal</button>
			</form>

			<v-flex xs12>
				<v-data-table
					:headers="headers"
					:items="data"
					:search="search"
					:items-per-page="10"
					class="elevation-2"
				>
					<template v-slot:item.action="{ item }">
						<v-icon color="error" @click="deleteItem(item)">mdi-delete</v-icon>
					</template>
				</v-data-table>
			</v-flex>
		</div>
	</div>
</template>
<script>
export default {
	props: ["id"],
	data() {
		return {
			headers: [
				{
					text: "Tipo",
					value: "tipo",
				},
				{
					text: "Peligrosidad",
					value: "peligrosidad",
				},
				{
					text: "cantidad",
					value: "cantidad",
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
			form: {
				nombre: " ",
				maximo: " ",
			},
			formAsignar: {
				tipo: " ",
				CorralId: this.id,
				cantidad: " ",
			},
			option: [],
			error: [],
			data: [],
		};
	},
	mounted() {
		this.getData();
		this.getValueOption();
	},
	methods: {
		getData() {
			axios.get("/api/corrales/addanimals/" + this.id).then(
				(response) => {
					//console.log("hola yumi:" + response.data[0]);
					this.data = response.data; //Para data de datatable
					this.form = {
						nombre: response.data[0].nombre,
						maximo: response.data[0].maximo,
					};
				}
			);
		},
		getValueOption() {
			axios.post("/api/option/value", this.data).then(
				(response) => {
					this.option = response.data;
					console.log(this.option);
				}
			);
		},
		StoreForm() {
			console.log(this.formAsignar);
			axios.post("/api/corrales/asing_animals", this.formAsignar)
				.then((response) => {
					if (response.data.status) {
						// console.log(response.data.messege);
						this.getData();
						this.$noty.success(response.data.messege);
						this.$router.push({
							name: "add_animales",
						});
					}
				})
				.catch((error) => {
					// console.log(error.response.data.errors);
					this.error = error.response.data.errors;
				});
		},
		deleteItem(item) {
			console.log(item.id_pivot);
			Swal.fire({
				title: "Desea ELiminar Registro ?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Eliminar Asignacion",
				cancelButtonText: "Cancelar",
			}).then((result) => {
				if (result.isConfirmed) {
					axios.delete("/api/corrales/eliminar_animals/" + item.id_pivot).then(
						(response) => {
							console.log("berhasil");
							const idx = this.data.indexOf(item);
							this.data.splice(idx, 1);

							Swal.fire(
								"Eliminado!",
								"EL Registro se elimino Correctamente!!.",
								"success"
							);
						}
					);
				}
			});
		},
	},
};
</script>
