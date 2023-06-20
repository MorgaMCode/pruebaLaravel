<template>
    <div>
        <div class="d-middle-center gap-2 flex-wrap">
            <div v-for="(statics, i) in value" :key="i" class="box-shadowBoxTwo d-middle gap-2 h-60px p-2 pe-4 br-8" style="width: 49.5%;">
                <div class="f-28 border br-8 wh-40" style="background-color: #D0F3E2; color: #64D69F">
                    <i :class="icons[i].icon" />
                </div>
                <p class="f-16 f-light">{{ statics.text }}</p>
                <p class="f-22 f-semibold text-green-clear ms-auto">{{ statics.price }}</p>
            </div>
        </div>
        <!-- two graphics -->
        <div class="d-flex gap-2 my-4 h-326px">
            <!-- graphic left -->
            <div class="w-20 box-shadowBoxTwo h-100 p-3 br-8">
                <p class="f-14 f-semibold text-center">Ventas por género del cliente</p>
                <div class="h-50 py-5 text-center">
                    <p>Esta es la grafica</p>
                </div>
                <table class="w-100 text-end">
                    <tr class="f-12">
                        <th class="text-start">Género</th>
                        <th class="text-center">Valor</th>
                        <th>Cupones</th>
                    </tr>
                    <tr class="border-bottom f-12 text-whitesmoke">
                        <td class="text-start d-middle gap-1">
                            <figure class="wh-12 rounded-circle mb-0" style="background-color: #FFB91D;" />
                            Hombres
                        </td>
                        <td>$2.600.000</td>
                        <td>260</td>
                    </tr>
                    <tr class="border-bottom f-12 text-whitesmoke">
                        <td class="text-start d-middle gap-1">
                            <figure class="wh-12 rounded-circle mb-0 bg-blue" />
                            mujeres
                        </td>
                        <td>$1.800.000</td>
                        <td>180</td>
                    </tr>
                    <tr class="border-bottom f-12 text-whitesmoke">
                        <td class="text-start d-middle gap-1">
                            <figure class="wh-12 rounded-circle mb-0" style="background-color: #FF8250;" />
                            Hombres
                        </td>
                        <td>$800.000</td>
                        <td>80</td>
                    </tr>
                </table>
            </div>
            <!-- graphicRight -->
            <graphic-main width="w-80">
                <p class="h-200px d-middle-center">grafica</p>
            </graphic-main>
        </div>
        <div class="mb-4">
            <graphicMain width="w-100">
                <p class="h-200px d-middle-center">grafica</p>
            </graphicMain>
        </div>
        <div class="mb-4">
            <graphicMain width="w-100" bgCoupons="bg-orange-light" bg-sales="bg-orange" bgGift="bg-red-badge">
                <p class="h-200px d-middle-center">grafica</p>
            </graphicMain>
        </div>
        <div class="mb-4">
            <graphicMain width="w-100">
                <p class="h-200px d-middle-center">grafica</p>
            </graphicMain>
        </div>
        <div class="mb-4">
            <p class="f-14 f-semibold">Mapa de calor de las órdenes facturadas con cupones aplicados</p>
            <div class="h-500px mt-3 bg-gray-light d-flex" >
                <div class="bg-white align-self-end br-8 w-137px h-151px bottom-0 mb-2 p-2">
                    <p class="f-12 f-medium">Unidades vendidas</p>
                    <div class="d-flex flex-column gap-1 mt-2">
                        <div class="d-middle gap-2">
                            <div class="wh-12 bg-red-badge rounded-circle" />
                            <p class="f-12 text-whitesmoke">400-500</p>
                        </div>
                        <div class="d-middle gap-2">
                            <div class="wh-12 bg-orange rounded-circle" />
                            <p class="f-12 text-whitesmoke">300-400</p>
                        </div>
                        <div class="d-middle gap-2">
                            <div class="wh-12 rounded-circle" style="background-color: #FDC479 ;" />
                            <p class="f-12 text-whitesmoke">200-300</p>
                        </div>
                        <div class="d-middle gap-2">
                            <div class="wh-12 bg-orange rounded-circle" style="background-color: #F4D096;" />
                            <p class="f-12 text-whitesmoke">100-200</p>
                        </div>
                        <div class="d-middle gap-2">
                            <div class="wh-12 bg-orange rounded-circle" style="background-color: #FBECBD;" />
                            <p class="f-12 text-whitesmoke">0-100</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import graphicMain from '../components/graphicMain.vue'
import { ref } from 'vue';

const props = defineProps({
    value: {
        type: Array,
        required: true
    }
})

const icons = ref([
    {
        id: 1,
        icon: 'icon-product'
    },
    {
        id: 2,
        icon: 'icon-bill'
    },
    {
        id: 3,
        icon: 'icon-gift'
    },
    {
        id: 4,
        icon: 'icon-account'
    }
])

</script>

<style lang="scss" scoped>

</style>