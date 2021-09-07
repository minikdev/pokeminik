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
import { computed } from '@vue/reactivity';
import { useStore } from "vuex";
import { watch } from '@vue/runtime-core';

export default {
    setup() {
        const store = useStore();
        const trainer = computed(() => store.state.authentication.trainer);
        const isLoading = computed(() => store.state.authentication.isLoading);

        return {
            isLoading,
            trainer,
        };
    },
};
</script>

<style></style>
