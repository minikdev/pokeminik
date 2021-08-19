<template>
    <div>
        <navigator></navigator>
        <v-main>
            <v-container fluid>

            <router-view></router-view>
            </v-container>
        </v-main>
    </div>
</template>

<script>
import Navigator from "../components/Navigator.vue";
export default {
    components: {
        Navigator,
    },
    setup() {},
};
</script>

<style>
/* .content{
    margin-left: 15rem;
    margin-top: 15rem;
} */
</style>
