<template>
	<v-app id="inspire">
		<v-navigation-drawer v-model="drawer" app>
			<v-list dense>
				<v-list-item to="/shop" link>
					<v-list-item-action>
						<v-icon>mdi-store</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>Shop</v-list-item-title>
					</v-list-item-content>
				</v-list-item>

                <template v-if="currentUser.id"> 
                    <v-list-item link to="/users">
                        <v-list-item-action>
                            <v-icon>mdi-account-group</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Users</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link to="/products">
                        <v-list-item-action>
                            <v-icon>mdi-package-variant-closed</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Products</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link @click="logout">
                        <v-list-item-action>
                            <v-icon>mdi-power</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Logout {{ currentUser.name }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
                <template v-else>
                    <v-list-item link to="/login">
                        <v-list-item-action>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Login {{ currentUser.name }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
			</v-list>
		</v-navigation-drawer>

		<v-app-bar app color="indigo" dark>
			<v-app-bar-nav-icon @click.stop="drawer = !drawer" />
			<v-toolbar-title>Products Catalog</v-toolbar-title>
		</v-app-bar>

		<v-content>
			<router-view></router-view>
		</v-content>
		<v-footer color="indigo" app>
			<span class="white--text">&copy; 2019</span>
		</v-footer>
	</v-app>
</template>

<script>
export default {
	props: {
		source: String
	},

	data: () => ({
		drawer: null
	}),
	computed: {
		loggedIn: {
			get() {
				return this.$store.state.currentUser.loggedIn;
			}
		},
		currentUser: {
			get() {
				return this.$store.state.currentUser.user;
			}
		}
	},
	methods: {
		logout() {
            this.$store.dispatch("currentUser/logoutUser");
		}
	},
	created() {
		if (localStorage.hasOwnProperty("store_token")) {
			axios.defaults.headers.common["Authorization"] =
				"Bearer " + localStorage.getItem("store_token");
			this.$store.dispatch("currentUser/getUser");
		}
	}
};
</script>
