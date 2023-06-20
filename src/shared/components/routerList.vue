<template>
    <template v-for="(item, index) in list" :key="index">
        <slot :item="item" :index="index" :selected="isSelected(item)" />
    </template>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute()

const props = defineProps({
    list:{
        type: Array,
    },
    nameRoute:{
        type: String
    }
})

function isSelected(item){
    return route.name.includes(item[props.nameRoute])
}

</script>

<style lang="scss" scoped>

</style>