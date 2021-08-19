import {createWebHistory,createRouter} from "vue-router"
import Home from "../views/Home"
import PokemonDetail from "../views/PokemonDetail"
const routes = [
    {
        path:"/",
        name:"Home",
        component:Home,
        children:[
            {
                path:"/pokemon/:id",
                name:"PokemonDetail",
                component:PokemonDetail,
                props:true
            }
        ]
    },


]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
