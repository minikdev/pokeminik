<template>
    <v-card>{{ id }}</v-card>
</template>

<script>
import { ref } from "@vue/reactivity";
import {watch} from "vue"
import { useRoute } from "vue-router";
export default {
    setup(props) {
        const route = useRoute();
        const id = ref(route.params.id);

        watch(() => route.params.id,
            async (newId) => {
                id.value = newId
                }
        );
        return {
            route,
            id,
        };
    },
};
</script>

<style></style>
