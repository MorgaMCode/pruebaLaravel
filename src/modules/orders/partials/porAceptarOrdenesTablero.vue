<template>
    <section class="overflow-hidden d-flex-column" style="min-width: 586px; max-width: 586px;">
        <div class="stylePorAceptar d-middle bg-orange-badge h-51px ps-3">
            <p class="f-semibold text-black f-18">{{ informationTablero.text }} ({{ informationTablero.cantidad }}) </p>
        </div>
        <div class="border overflow-auto hidden-scroll bg-white h-100">
            <div v-for="date in informationTablero.tableroCuadroInformacion" class="d-flex flex-column position-relative" @click="openDrawer = true">
                <div class="h-40px d-middle ps-3">
                    <p class="f-medium f-14">{{ date.dia }} ({{ date.cantidad }})</p>
                </div>
                <div class="d-flex flex-wrap" style="border-bottom: 4px solid #dedede;">
                    <orders-to-go-route-tablero
                        v-for="(pedido, i) in date?.ordersCuadro"
                        :key="i"
                        :pedidoInformation="pedido"
                        :indice="i"
                    />
                    <div class="w-1px bg-gray-light position-absolute" style="left: 290px; height: calc(100% - 40px);" />
                </div>
            </div>
            <el-drawer v-model="openDrawer" :show-close="false" size="442">
                <template #header>
                    <div>
                        <div class="d-middle-bt border-bottom p-3">
                            <div class="d-middle gap-3">
                                <div class="br-5 px-4 py-2" :class="[ pasarPorDetalles ? 'bg-blue-state-lightest text-blue': 'bg-blue-lightest gray-light-hover cr-pointer text-grey-light' ]" @click="toGoDetails('idiDetails')">
                                    <p class=" f-14">Detalles</p>
                                </div>
                                <div class=" br-5 px-4 py-2" :class="[ pasarPorProductos ? 'bg-blue-state-lightest text-blue': 'bg-blue-lightest text-grey-light gray-light-hover cr-pointer' ]" @click="toGoDetails('idiProducts')">
                                    <p class="f-14">Productos</p>
                                </div>
                            </div>
                            <div class="d-middle-center icon-hover-blue rounded-circle cr-pointer wh-32" @click="openDrawer = false">
                                <i class="icon-close-2 f-25" />
                            </div>
                        </div>
                        <ordenesEstadoPrincipalArriba :state="informationState" borderAbajo="border-bottom py-3" />
                    </div>
                </template>
                <template #default>
                    <div class="parentRequest overflow-auto decoration-scroll h-100" @scroll="scrollMain">
                        <div>
                            <ordenes-estado-primero />
                        </div>
                        <div>
                            <ordenes-estado-segundo />
                        </div>
                        <div>
                            <ordenes-estado-tercero :mostrarChatCliente="false" />
                        </div>
                        <div>
                            <ordenes-estado-cuarto />
                        </div>
                        <div>
                            <ordenes-estado-quinto />
                        </div>
                        <div>
                            <ordenes-estado-sexto />
                        </div>
                        <div>
                            <ordenes-estado-septimo idi="idiDetails" />
                        </div>
                        <div>
                            <ordenes-estado-octavo />
                        </div>
                        <div>
                            <ordenes-estado-noveno />
                        </div>
                        <div class="px-3 py-4">
                            <productosOrdenesComida idi="idiProducts" :products="informationsProductsFood" />
                        </div>
                    </div>
                </template>
            </el-drawer>
        </div>
    </section>
</template>

<script setup>
import ordenesEstadoPrincipalArriba from './ordenesEstadoPrincipalArriba.vue';
import ordenesEstadoPrimero from './ordenesEstadoPrimero.vue';
import ordenesEstadoSegundo from './ordenesEstadoSegundo.vue';
import ordenesEstadoTercero from './ordenesEstadoTercero.vue';
import ordenesEstadoCuarto from './ordenesEstadoCuarto.vue';
import ordenesEstadoQuinto from './ordenesEstadoQuinto.vue';
import ordenesEstadoSexto from './ordenesEstadoSexto.vue';
import ordenesEstadoSeptimo from './ordenesEstadoSeptimo.vue';
import ordenesEstadoOctavo from './ordenesEstadoOctavo.vue';
import ordenesEstadoNoveno from './ordenesEstadoNoveno.vue';
import ordersToGoRouteTablero from '../components/ordersToGoRouteTablero.vue';
import productosOrdenesComida from './productosOrdenesComida.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const openDrawer = ref(false)
const pasarPorDetalles = ref(false)
const pasarPorProductos = ref(false)

let route = useRoute()
let timer

let props = defineProps({
    informationTablero:{
        type: Object,
        required: true,
        default: () => {}
    },
    informationState:{
        type: Object,
        required: false,
        default: () => {}
    },
    informationsProductsFood:{
        type: Array,
        required: false,
        default: () => []
    }
})

function scrollMain(){
    let etiquetaDestinoDeatils = document.querySelector('#idiDetails')
    let etiquetaDestinoProducts = document.querySelector('#idiProducts')

    let readLabelDetails = etiquetaDestinoDeatils.getBoundingClientRect()
    let readLabelProducts = etiquetaDestinoProducts.getBoundingClientRect()

    let height = window.innerHeight || document.documentElement.clientHeight

    let seeLabelSizeDetails = (
        readLabelDetails.bottom >= 0 &&
        readLabelDetails.top <= height
    )

    let seeLabelSizeProducts = (
        readLabelProducts.bottom >= 0 &&
        readLabelProducts.top <= height
    )
    pasarPorDetalles.value = seeLabelSizeDetails
    pasarPorProductos.value = seeLabelSizeProducts
}

function toGoDetails(idi){
    let etiquetaDestinoDeatils = document.querySelector('#idiDetails')
    let etiquetaDestinoProducts = document.querySelector('#idiProducts')
    if(idi === etiquetaDestinoDeatils.getAttribute('id')){
        etiquetaDestinoDeatils.scrollIntoView({ behavior: 'smooth' })
    }else if(idi === etiquetaDestinoProducts.getAttribute('id')){
        etiquetaDestinoProducts.scrollIntoView({ behavior: 'smooth' })
    }
}

function open(){
    openDrawer.value = true
}

function close(){
    openDrawer.value = false
}

defineExpose({
    open,
    close
})

</script>

<style lang="scss" scoped>

.parentRequest{
    div{
        border-bottom: 3px solid #e1e1e1;
    }
}
.stylePorAceptar{
    border-radius: 8px 8px 0px 0px;
    border-bottom: 2px solid #FF991F;
}

</style>