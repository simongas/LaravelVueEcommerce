import Axios from "axios";

const state = {
    user: {},
    totals: {
        cost: 0.00,
        quantity: 0
    },
    products: []
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
    },
    updateProducts({commit}, products) {
        commit('setProducts', products);
        let totals = {}
        totals.cost = 0;
        products.map(function(value, key) {
            totals.cost += value.price;
        });
        totals.quantity = products.length
        commit('setTotals', totals);
    }
}
const mutations = {
    setUser(state, data){
        state.user = data;
    },
    setProducts(state, data){
        state.products = data;
    },
    setTotals(state, data){
        state.totals = data;
    }
}

export default{
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}