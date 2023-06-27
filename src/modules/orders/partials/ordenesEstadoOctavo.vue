<template>
    <div class="p-3">
        <p class="f-medium f-16">Instrucciones:</p>
        <p class="f-light f-14">{{  instructions.observacionOrden }}</p>
    </div>
</template>

<script setup>

const  porps = defineProps({
    instructions:{
        type:Object
    }
})

</script>

<style lang="scss" scoped>

</style>