import {createStore} from "vuex"
import pokemon from "./modules/pokemon"
import authentication from "./modules/authentication"

export default createStore({
    modules:{
        pokemon,
        authentication
    }

})
