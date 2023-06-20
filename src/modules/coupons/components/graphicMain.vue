<template>
    <div class="box-shadowBoxTwo br-8 h-100 ps-3 pe-4 py-3" :class="width">
        <header class="d-middle-bt">
            <p class="f-14 f-semibold">{{ titleTopLeft }}</p>
            <div class="d-middle gap-3 f-12 text-whitesmoke">
                <div class="d-middle gap-2">
                    <div class="wh-12" :class="bgCoupons" />
                    <p>{{ titleTopOne }}</p>
                </div>
                <div class="d-middle gap-2">
                    <div class="wh-12 rounded-circle" :class="bgSales" />
                    <p>{{ titleTopTwo }}</p>
                </div>
                <div class="d-middle gap-2">
                    <div class="wh-12 rounded-circle" :class="bgGift" />
                    <p>{{ titleTopThree }}</p>
                </div>
            </div>
        </header>
        <slot></slot>
    </div>
</template>

<script setup>

const props = defineProps({
    width:{
        type: String,
        default: 'w-100'
    },
    bgGift: {
        type: String,
        default: 'bg-grey'
    },
    bgSales: {
        type: String,
        default: 'bg-blue'
    },
    bgCoupons: {
        type: String,
        default: 'bg-blue-state-lightest'
    },
    titleTopOne:{
        type: String,
        default: 'Cupones aplicados'
    },
    titleTopTwo:{
        type: String,
        default: 'Ventas'
    },
    titleTopThree:{
        type: String,
        default: 'Obsequio'
    },
    titleTopLeft:{
        type: String,
        default: 'Ventas por edades de los clientes'
    }
})

</script>

<style lang="scss" scoped>

</style>