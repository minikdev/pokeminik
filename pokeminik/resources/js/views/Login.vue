<template>
    <div>
        <v-row style="margin-top: 2rem">
            <v-col md="10" offset="1">
                <v-card>
                    <v-progress-circular
                        indeterminate
                        v-if="isLoading"
                        class="progress-center"
                    ></v-progress-circular>
                    <v-container v-if="!isLoading">
                        <v-row>
                            <v-col md="10" offset="1">
                                <v-banner rounded="pill">
                                    <v-icon>mdi-account</v-icon>
                                    <input
                                        type="text"
                                        placeholder="Username"
                                        v-model="username"
                                    />
                                </v-banner>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col md="10" offset="1">
                                <v-banner rounded="pill">
                                    <v-icon>mdi-key</v-icon>
                                    <input
                                        type="password"
                                        v-model="password"
                                        placeholder="Password"
                                    />
                                </v-banner>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col md="10" offset="1">
                                <p @click="moveToRegister">
                                    Don't you have account? Register
                                </p>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col md="2" offset="9">
                                <v-btn
                                    rounded="lg"
                                    @click="login"
                                    color="deep-orange-darken-1"
                                    :disabled="!isValid"
                                    >Login</v-btn
                                >
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { computed, ref } from "@vue/reactivity";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { watch } from "@vue/runtime-core";
export default {
    setup() {
        const router = useRouter();
        const username = ref("");
        const password = ref("");
        const isValid = ref(false);
        const moveToRegister = () => {
            router.push({ name: "Register" });
        };
        const store = useStore();
        const login = () =>
            store.dispatch("authentication/login", {
                username: username.value,
                password: password.value,
            }).then(()=>{
                router.push({name:"PokemonDetail",params: { id: 1 }})
            })

        const isLoading = computed(() => store.state.authentication.isLoading);
        watch([username, password], ([username, password]) => {
            if (username.length > 0 && password.length > 0) {
                isValid.value = true;
            } else {
                isValid.value = false;
            }
        });

        return {
            moveToRegister,
            username,
            password,
            login,
            isLoading,
            isValid,
        };
    },
};
</script>

<style scoped>
input {
    width: 100%;
    margin-left: 0.5rem;
}
v-col {
    margin: 2rem;
}
p {
    font-size: smaller;
    font-weight: bolder;
    margin-top: 1rem;
    cursor: pointer;
}
.progress-center {
    top: 50%;
    left: 50%;
}
</style>
