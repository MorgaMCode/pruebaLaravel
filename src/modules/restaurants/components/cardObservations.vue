<template>
    <div class="observations d-middle br-8 pe-3 ps-1 item-with-hover cr-pointer" :class="classAdditional" style="border: 1px solid var(--gray-light);" @click="emit('openObservations')" >
        <i class="f-23" :class="icono" />
        <p class="f-14 f-medium">{{ observations }}</p>
    </div>
</template>

<script setup>

const props = defineProps({
    observations:{
        type: String,
        required: false,
        default: 'Oberservaciones'
    },
    icono:{
        type: String,
        equired: false,
        default: 'icon-info-outline'
    },
    classAdditional: {
        type: String,
        required: false
    }
})

const emit = defineEmits(['openObservations'])

</script>

<style lang="scss" scoped>
.observations{
    transition: .3s;
    &:hover{
        border: 1px solid transparent !important ;
    }
}

</style>