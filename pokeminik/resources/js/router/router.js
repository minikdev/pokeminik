import {createWebHistory,createRouter} from "vue-router"
import Home from "../views/Home"
import PokemonDetail from "../views/PokemonDetail"
import Login from "../views/Login"
import Register from "../views/Register"
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
            },
            {
                path:"/login",
                name:"Login",
                component:Login
            },
            {
                path:"/register",
                name:"Register",
                component:Register
            }
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
