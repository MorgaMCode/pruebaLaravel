<template>
    <div class="d-middle gap-2 pb-2">
        <img :src="option.img" alt="imageOperaciones" class="wh-39" />
        <div>
            <p class="text-black f-14">{{ option.text }}</p>
            <p class="text-grey-light f-12">{{ option.tipo }}</p>
        </div>
    </div>
    <slot name="optionsDesplegable" />
</template>

<script setup>

let props = defineProps({
    option:{
        type: Object,
        required: true,
        default: () => {}
    }
})

</script>

<style lang="scss" scoped>

</style>