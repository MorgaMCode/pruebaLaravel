<template>
    <div class="d-middle gap-1 br-13 px-2" :class="[stateValue[states]?.bg, stateValue[states]?.textColor]" style="padding: 2px 0px;">
        <div class="wh-20 d-middle-center">
            <i class="f-20" :class="stateValue[states]?.icon" />
        </div>
        <p class="f-12">{{ stateValue[states]?.text }}</p>
    </div>
</template>

<script setup>

let props = defineProps({
    states: {
        type: Number,
        required: true,
        default: ''
    }
})

const stateValue = {
    11: { bg: 'bg-orange', icon: 'icon-orders-outline', text: 'Por aceptar' },
    12: { bg: 'bg-yellow', icon: 'icon-check', text: 'Aceptado' },
    13: { bg: 'bg-blueOscuro', icon: 'icon-cooking', text: 'Preparando' },
    14: { bg: 'bg-blue-state-lightest', textColor: 'text-blue',icon: 'icon-delivery', text: 'En camino' },
    15: { bg: 'bg-green-clear', textColor: 'text-black',icon: 'icon-box-delivery', text: 'por entregar' },
}

</script>

<style lang="scss" scoped>

.bg-blueOscuro{
    background-color: #00A3BF;
}

</style>