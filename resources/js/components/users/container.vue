<template>
	<div>
        USERS
    </div>
</template>    

<script>
export default {
    created(){
        if (!localStorage.store_token) {		
            this.$store.dispatch("currentUser/logoutUser")
		}
    }
};
</script>