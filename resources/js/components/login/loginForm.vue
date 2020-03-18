<template>
    <div cols="12">
        <v-container cols="12">
            <v-row>
                <v-col
                cols="12"
                md="6"
                >
                    <v-text-field
                        v-model="user.email"
                        label="E-mail"
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                cols="12"
                md="6"
                >
                    <v-text-field
                        v-model="user.password"
                        label="Password"
                        type="password"
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                cols="12"
                md="6"
                >
                    <v-btn
                        color="primary"
                        @click="login"
                    >
                        Login
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
	data: () =>({
        user: {
            email: "",
            password: ""
        }
    }),
    methods: {
        login(){
            this.$store.dispatch('currentUser/loginUser', this.user);
        }
    }
};
</script>
