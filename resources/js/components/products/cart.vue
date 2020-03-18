<template>
	<v-data-table :headers="headers" :items="items" sort-by="name" class="elevation-1">
		<template v-slot:top>
			<v-toolbar flat color="white">
				<v-toolbar-title>Products</v-toolbar-title>
				<v-divider class="mx-4" inset vertical></v-divider>
				<v-spacer></v-spacer>
				<v-dialog v-model="dialog" max-width="500px">
					<template v-slot:activator="{ on }">
						<v-btn color="primary" dark class="mb-2" v-on="on">New Product</v-btn>
					</template>
					<v-card>
						<v-card-title>
							<span class="headline">{{ formTitle }}</span>
						</v-card-title>

						<v-card-text>
							<v-container>
								<v-row>
									<v-col cols="12" sm="6" md="4">
										<v-text-field v-model="editedItem.name" label="Product Name"></v-text-field>
									</v-col>
									<v-col cols="12" sm="6" md="4">
										<v-text-field v-model="editedItem.slug" label="Slug"></v-text-field>
									</v-col>
									<v-col cols="12" sm="6" md="4">
										<v-text-field v-model="editedItem.price" label="Price"></v-text-field>
									</v-col>
									<v-col cols="12" sm="12" md="12">
										<v-text-field v-model="editedItem.description" label="Description"></v-text-field>
									</v-col>
								</v-row>
							</v-container>
						</v-card-text>

						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
							<v-btn color="blue darken-1" text @click="save">Save</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-toolbar>
		</template>
		<template v-slot:item.actions="{ item }">
			<v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
			<v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
		</template>
		<template v-slot:no-data>
			<v-btn color="primary" @click="initialize">Reset</v-btn>
		</template>
	</v-data-table>
</template>

<script>
export default {
	data: () => ({
		dialog: false,
		headers: [
			{ text: "Name", value: "name" },
			{ text: "Slug", value: "slug" },
			{ text: "Description", value: "description" },
			{ text: "Price", value: "price" },
			{ text: "Actions", value: "actions", sortable: false }
		],
		items: [],
		editedIndex: -1,
		editedItem: {
			name: "",
			slug: "",
			description: "",
			price: 0,
			id: 0
		},
		defaultItem: {
			name: "",
			slug: "",
			description: "",
			price: 0
		}
	}),

	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		}
	},

	watch: {
		dialog(val) {
			val || this.close();
		}
	},

	created() {
		this.initialize();
	},

	methods: {
		initialize() {
			axios.get("/api/products/all").then(response => {
				console.log(response.data);
				if (response.data) {
					this.items = response.data;
				}
				console.log(this.items);
			});
		},

		editItem(item) {
			this.editedIndex = this.items.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) {
			const index = this.items.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				axios.get("/api/products/delete/" + item.id).then(response => {
					this.items = response.data;
				});
		},

		close() {
			this.dialog = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		save() {
			// Update
			if (this.editedIndex > -1) {
				axios
					.post("/api/products/update", this.editedItem)
					.then(response => {
						this.items = response.data;
					});
			} else {
				// Create
				axios
					.post("/api/products/create", this.editedItem)
					.then(response => {
						this.items = response.data;
					});
			}
			this.close();
		}
	}
};
</script>