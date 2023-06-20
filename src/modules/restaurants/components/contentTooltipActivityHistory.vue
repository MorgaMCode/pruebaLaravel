<template>
    <el-tooltip placement="bottom" effect="light">
        <template #content>
            <div class="d-middle text-green-clear">
                <i class="icon-sun f-20" />
                <p>{{ store }}</p>
            </div>
            <p class="text-whitesmoke">{{ horaInicio }} - {{ horaFinal }}</p>
            <p v-if="people" class="text-whitesmoke">Por: {{ people }}</p>
            <p class="text-whitesmoke">{{ horas }}</p>
        </template>
        <slot></slot>
    </el-tooltip>
</template>

<script setup>

let props = defineProps({
    store: {
        type: String,
        required: false,
        default: 'Tienda abierta'
    },
    horaInicio: {
        type: String,
        required: false,
        default: '10:00 am'
    },
    horaFinal: {
        type: String,
        required: false,
        default: '2:00 pm'
    },
    people: {
        type: String,
        required: false
    },
    horas: {
        type: String,
        required: false,
        default: 'Horas: 4'
    }
})

</script>

<style lang="scss" scoped>

</style>