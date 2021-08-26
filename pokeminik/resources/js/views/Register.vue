<template>
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
                            <v-banner rounded="pill">
                                <v-icon>mdi-key</v-icon>
                                <input
                                    type="password"
                                    v-model="repeatPassword"
                                    placeholder="Repeat Password"
                                />
                            </v-banner>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col md="10" offset="1">
                            <v-banner rounded="pill">
                                <v-icon>mdi-gender-male-female</v-icon>
                                <select name="gender" v-model="gender">
                                    <option  value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </v-banner>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col md="2" offset="9">
                            <v-btn
                                rounded="lg"
                                @click="register"
                                color="deep-orange-darken-1"
                                :disabled="!isValid"
                                >Register</v-btn
                            >
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import { ref, computed } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRouter } from 'vue-router';
export default {
    setup(props) {
        const store = useStore();
        const username = ref("");
        const password = ref("");
        const repeatPassword = ref("");
        const gender = ref("Male");
        const isValid = ref(false);
        const router = useRouter();
        watch(
            [username, password, repeatPassword],
            ([username, password, repeatPassword]) => {
                if (
                    username.length > 0 &&
                    password.length > 0 &&
                    repeatPassword &&
                    password === repeatPassword
                ) {
                    isValid.value = true;
                } else {
                    isValid.value = false;
                }
            }
        );
        const isLoading = computed(() => store.state.authentication.isLoading);

        const register = () =>
            store.dispatch("authentication/register", {
                username: username.value,
                password: password.value,
                repeatPassword: repeatPassword.value,
                gender: gender.value,
            }).then(()=>{
                router.push({name:"PokemonDetail",params: { id: 1 }})
            });
        return {
            username,
            password,
            repeatPassword,
            gender,
            isValid,
            isLoading,
            register,
        };
    },
};
</script>

<style>
input,
select {
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
