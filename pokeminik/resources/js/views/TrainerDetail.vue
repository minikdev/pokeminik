<template>
    <div>
        <div class="loader-container">
            <v-progress-circular
                indeterminate
                v-if="isLoading"
            ></v-progress-circular>
            <div v-if="!isLoading">
                {{trainer.username}}
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, watch } from "@vue/runtime-core";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

export default {
    setup(props) {
        const store = useStore();
        const route = useRoute();
        const trainer = computed(() => store.state.authentication.trainer);
        const trainerId = ref("");
        const isLoading = computed(() => store.state.authentication.isLoading);
        const fetchTrainer = () =>
            store.dispatch("authentication/fetchTrainer", trainerId.value);
        onMounted(async () => {
            trainerId.value = route.params.id;
            await fetchTrainer();
            console.log(trainer.value.username);
        });
        watch(
            () => route.params.id,
            async (newId) => {
                trainerId.value = newId;
                await fetchTrainer();
                console.log(trainer.value);
            }
        );

        return {
            isLoading,
            trainer,
        };
    },
};
</script>

<style></style>
