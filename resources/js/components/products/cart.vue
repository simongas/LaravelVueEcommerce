<template>
	<v-data-table :headers="headers" :items="cart" sort-by="name" class="elevation-1">
		<template v-slot:top>
			<v-toolbar flat color="white">
				<v-toolbar-title>Shopping Cart - Please Review Your Order</v-toolbar-title>
				<v-divider class="mx-4" inset vertical></v-divider>
				<v-spacer></v-spacer>
			</v-toolbar>
		</template>
		<template v-slot:item.actions="{ item }">
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
		cart: []
	}),

	created() {
		this.initialize();
	},

	methods: {
		initialize() {
			this.cart = this.$store.state.currentUser.products;
		},

		deleteItem(item) {
			const index = this.cart.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.cart.splice(index, 1);
			this.$store.dispatch("currentUser/updateProducts", this.cart);
		}
	}
};
</script>