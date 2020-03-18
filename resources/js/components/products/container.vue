<template>
	<div>
		<v-container fluid>
			<v-row dense>
				<v-col v-for="item in items" :key="item.slug" :cols="4">
					<v-card>
						<v-card-title>{{item.name}}</v-card-title>
						<v-card-text>{{item.description}}</v-card-text>
						<v-card-actions>
							<v-btn :to="`/products/${item.slug}`" id="slug" text color="deep-purple accent-4">View More</v-btn>
						</v-card-actions>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>    

<script>
export default {
	data() {
		return {
			items: []
		};
	},
	created() {
		axios.get("/api/products/all").then(response => {
			console.log(response.data);
			if (response.data) {
				this.items = response.data;
			}
			console.log(this.items);
		});
	}
};
</script>