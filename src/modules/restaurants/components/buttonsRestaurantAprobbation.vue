<template>
    <div class="d-middle-center position-relative gap-3 h-80px bg-white h-80px w-100" style="z-index: 2;">
        <div class="border-whitesmoke br-5 d-middle pe-3" style="background-color: #97A0B01C !important;">
            <i class="icon-info-outline f-25 text-whitesmoke" />
            <p class="f-13 f-medium text-whitesmoke">{{ contentAdvertence }}</p>
        </div>
        <buttonAction width="w-88px" button-content="Aprobar" @open="emit('openSelectionApprove')" />
        <buttonAction
            button-content="Enviar observaciones"
            width="w-182"
            classDinamic="px-3"
            bg="bg-white"
            text-color="text-black"
            border-color="border-gray-light"
            @open="emit('openObservationsModal')"
        />
        <buttonAction
            button-content="Rechazar"
            width="w-90px"
            bg="bg-red-badge-light"
            text-color="text-red"
            @open="emit('openRejectedModal')"
        />
        <buttonAction
            bg="bg-blue-state-lightest"
            text-color="text-blue"
            width="w-102px"
            border-color="border-blue"
            button-content="Recuperar"
            @open="emit('openRecoverRestaurantModal')"
        />
    </div>
</template>

<script setup>
import buttonAction from '../../../shared/components/buttonAction.vue';

let props = defineProps({
    contentAdvertence: {
        type: String,
        required: true,
        default: 'El restaurante está esperando tu aprobación para empezar a vender'
    }
})

let emit = defineEmits(['openSelectionApprove', 'openObservationsModal', 'openRejectedModal', 'openRecoverRestaurantModal'])

</script>

<style lang="scss" scoped>

</style>