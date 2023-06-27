<template>
    <div  class="pe-2">
        <p class="f-20 mb-2">Productos</p>
        
        <div v-for="(product, i) in products" :key="i" class="border-bottom">
            <div class="d-flex gap-4 j-between py-3">
                <img :src="product.imagenMini?? 'https://cdn.aarp.net/content/dam/aarp/health/caregiving/2018/03/1140-nutrients-food-loved-ones-caregiving-esp.jpg' " alt="imageBurguerKiller" width="60" height="75" />
                <div class="w-100 d-flex flex-column j-center gap-1">
                    <p class="f-medium f-16">{{ product.nombre }}</p>
                    <div class="align-self-end bg-blue-state-lightest rounded-pill px-2">
                        <p class="f-12">x {{ product.cantidad }}</p>
                    </div>
                    <div  class="d-middle gap-2">
                        <p class="f-16">$ {{ product.precioProducto }}</p>
                        <p class="text-whitesmoke f-16" style="text-decoration: line-through;">$ {{ product.precioTeorico }}</p>
                    </div>
                    
                </div>
            </div>
            <template v-if="product.toppingsGrupos?.length">
                <div
                    v-for="(caracteristica, i) in product.toppingsGrupos"
                    :key="i"
                    class="mb-4 ms-4"
                >
                    <p class="f-medium f-16 mb-2">{{ caracteristica.nombre }}</p>
                    <div v-for="(info,i) in caracteristica.toppings" :key="i" class="d-middle-bt">
                        <p class="f-14">{{ info.nombre }}</p>
                        <div class="d-middle gap-3">
                            <p v-if="info.precioToppingTotal" class="text-black f-14">$ {{ info.precioToppingTotal }}</p>
                            <div class="bg-blue-state-lightest rounded-pill px-2">
                                <p class="f-12">x {{ info.cantidad }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>

let props = defineProps({
    products:{
        type: Array,
        required: true,
        default: () => []
    },
    idi:{
        type: String,
        required: false,
        default: 'idiProducts'
    }
})

</script>

<style lang="scss" scoped>

</style>