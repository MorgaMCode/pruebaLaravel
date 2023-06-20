<template>
    <div>
        <h4 class="f-bold f-24">Parametrización</h4>
        <p class="mb-2 f-18">{{ subtitle }}</p>
        <slot></slot>
        <div v-if="description" class="border-blue w-100 px-3 py-2 br-8 f-15 lh-23">
            <p>{{ description }}</p>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    subtitle: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    }
})
</script>

<style lang="scss" scoped>

</style>