import {createWebHistory,createRouter} from "vue-router"
import {App} from "../components/App.vue";
const routes = [
    {
        path:"/",
        name:"Navigator",
        component:()=> import ("../components/Navigator.vue")
    },
     {
        path:"/pokemon/{id}",
        name:"PokemonDetail",
        component:()=> import ("../components/PokemonDetail.vue")
    }

]

const router = createRouter({
    history: createWebHistory("/"),
    routes
})

export default router
