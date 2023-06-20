<template>
    <div :id="idi" class="pe-2">
        <p class="f-20 mb-2">Productos</p>
        <div v-for="(product, i) in products" :key="i" class="border-bottom">
            <div class="d-flex gap-4 j-between py-3">
                <img :src="product.img" alt="imageBurguerKiller" width="60" height="75" />
                <div class="w-100 d-flex flex-column j-center gap-1">
                    <p class="f-medium f-16">{{ product.title }}</p>
                    <div class="align-self-end bg-blue-state-lightest rounded-pill px-2">
                        <p class="f-12">{{ product.oferta }}</p>
                    </div>
                    <div v-if="product.precioOferta" class="d-middle gap-2">
                        <p class="f-16">$ {{ product.precioOferta }}</p>
                        <p class="text-whitesmoke f-16" style="text-decoration: line-through;">$ {{ product.precioNormal }}</p>
                    </div>
                    <div v-else class="d-middle gap-2">
                        <p class="f-16">$ {{ product.precioNormal }}</p>
                    </div>
                </div>
            </div>
            <template v-if="product.productoCaracteristicas.length">
                <div
                    v-for="(caracteristica, i) in product.productoCaracteristicas"
                    :key="i"
                    class="mb-4 ms-4"
                >
                    <p class="f-medium f-16 mb-2">{{ caracteristica.title }}</p>
                    <div v-for="info in caracteristica.caracteristicas" class="d-middle-bt">
                        <p class="f-14">{{ info.text }}</p>
                        <div class="d-middle gap-3">
                            <p v-if="info.price" class="text-black f-14">$ {{ info.price }}</p>
                            <div class="bg-blue-state-lightest rounded-pill px-2">
                                <p class="f-12">x {{ info.numberOferta }}</p>
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