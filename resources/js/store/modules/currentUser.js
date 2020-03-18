import Axios from "axios";

const state = {
    user: {},
    products: {}
};
const getters = {}
const actions = {
    getUser({commit}){
      axios.get("/api/users/current").then(response => {
        commit('setUser', response.data);
      })  
    },
    loginUser({}, user){
        axios.post("/api/users/login",{
            email: user.email,
            password: user.password
        })
        .then(response => {
            console.log(response.data)
            if(response.data.access_token){
                localStorage.setItem(
                    "store_token",
                    response.data.access_token
                )
                localStorage.setItem("loggedIn", true)
                window.location.replace("/users");
            }

        })
    },
    logoutUser() {
        localStorage.removeItem('store_token');
        if(window.location.pathname != "/"){
            window.location.replace("/")
        }
    }
}
const mutations = {
    setUser(state, data){
        state.user = data;
    },
    setProducts(state, data){
        state.products = data
    }
}

export default{
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}