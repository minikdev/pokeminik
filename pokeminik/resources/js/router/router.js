import {createWebHistory,createRouter} from "vue-router"
import Home from "../views/Home"
import PokemonDetail from "../views/PokemonDetail"
import Profile from "../views/Profile"
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
            },
            // {
            //     path:"/trainer/:id",
            //     name:"TrainerDetail",
            //     component:TrainerDetail,
            //     props:true
            // },
            {
                path:"/profile",
                name:"Profile",
                component:Profile,
                props:true,
                meta: {
                    requiresAuth: true
                }
            }
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
const isAuthenticated = window.localStorage.getItem("token");
router.beforeEach((to, from, next) => {
    debugger
    if (to.meta?.requiresAuth && isAuthenticated ) {
      // let users enter if authenticated
        next()
    } else if (to.meta?.requiresAuth) {
      // otherwise, route them to /login
      next('/login')
    } else {
      next()
    }
  })
export default router
