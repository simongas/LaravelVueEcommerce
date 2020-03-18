<template>
	<v-card class="mx-auto" max-width="500">
		<v-system-bar color="indigo darken-2" dark>
			<v-spacer></v-spacer>

			<v-icon>mdi-window-minimize</v-icon>

			<v-icon>mdi-window-maximize</v-icon>

			<v-icon>mdi-close</v-icon>
		</v-system-bar>

		<v-toolbar color="indigo" dark>
			<v-app-bar-nav-icon></v-app-bar-nav-icon>

			<v-toolbar-title>{{ item.name }}</v-toolbar-title>

			<v-spacer></v-spacer>

			<v-btn icon>
				<v-icon>mdi-magnify</v-icon>
			</v-btn>
		</v-toolbar>

		<v-container fluid>
			<v-row dense>
				<v-col cols="12">
					<v-card>
						<v-img
							src="/img/no-image-slide.webp"
							class="white--text align-end"
							gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
							height="200px"
						>
							<v-card-title v-text="item.name"></v-card-title>
						</v-img>
						<v-card-text v-text="item.description"></v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>

							<v-btn icon @click="addToCart(item)">
								<v-icon>mdi-cart-plus</v-icon>
							</v-btn>
						</v-card-actions>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-card>
</template>  

<script>
export default {
	data() {
		return {
			item: [],
			cart: []
		};
	},
	computed: {
		products: {
			get() {
				return this.$store.state.currentUser.products;
			}
		}
	},
	created() {
		axios.get("/api/products/" + this.$route.params.slug).then(response => {
			console.log(response.data);
			if (response.data) {
				this.item = response.data;
			}
		});
		this.cart = this.$store.state.currentUser.products;
	},
	methods: {
		addToCart(item) {
			this.cart.push(item);
			this.$store.dispatch("currentUser/updateProducts", this.cart);
		}
	}
};
</script>