<template>
    <div class="px-5 pt-2 overflow-auto hidden-scroll h-100" style="padding-bottom: 100px;">
        <h1 class="f-20 f-semibold">Tipos de entrega</h1>
        <p class="text-whitesmoke ps-3 f-14">Tipos de entrega por nivel de demanda</p>
        <article v-for="(demanda, i) in demandas" :key="i" class="mb-5">
            <div class="d-flex gap-2 my-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="wh-21" :fill="demanda.color">
                    <path :d="demanda.icon" />
                </svg>
                <h2 class="f-semibold mb-0 f-22">{{ demanda.title }}</h2>
            </div>
            <div class="d-middle">
                <i :class="demanda.caracteristicas.caracteristicasDomicilio.icon" class="f-25" />
                <p class="f-medium f-16">{{ demanda.caracteristicas.caracteristicasDomicilio.text }}</p>
            </div>
            <p v-if="deliveryTypeDatas[demanda.caracteristicas.caracteristicasDomicilio.entregaDomicilio]" class="text-whitesmoke f-14"> {{ demanda.caracteristicas.caracteristicasDomicilio.subtext }}</p>
            <div v-else class="d-middle mb-4">
                <i class="icon-alerta text-orange f-25" />
                <p class="text-whitesmoke f-14">{{ demanda.caracteristicas.caracteristicasDomicilio.textAdvertence }}</p>
            </div>
            <!-- cuadro de informacion del domcilio -->
            <section v-if="deliveryTypeDatas[demanda.caracteristicas.caracteristicasDomicilio.entregaDomicilio]" class="my-2">
                <tablaTiendaDeDomicilios :tablaDomicilios="deliveryTypeDatas[demanda.demanda]" />
            </section>
            <div class="d-middle">
                <i class="f-25" :class=" demanda.caracteristicas.caracteristicasStore.icon " />
                <p class="f-medium f-16">{{  demanda.caracteristicas.caracteristicasStore.text   }}</p>
            </div>
            <p v-if="deliveryTypeDatas[demanda.caracteristicas.caracteristicasStore.entregaRecoge]" class="text-whitesmoke f-14 ps-2">
                {{  demanda.caracteristicas.caracteristicasStore.subtext }}
                <span class="text-black ps-1">
                    {{ deliveryTypeDatas[demanda.caracteristicas.caracteristicasStore.recogeDesde] }}
                    min
                     -
                    {{ deliveryTypeDatas[demanda.caracteristicas.caracteristicasStore.recogeHasta] }}
                    min
                </span>
            </p>
            <div v-else class="d-middle mb-4">
                <i class="icon-alerta text-orange f-25" />
                <p class="text-whitesmoke f-14">{{ demanda.caracteristicas.caracteristicasStore.textAdvertence }}</p>
            </div>
            <div class="d-middle mt-4">
                <i :class="   demanda.caracteristicas.caracteristicasTable.icon" class="f-25" />
                <p class="f-medium f-16">{{   demanda.caracteristicas.caracteristicasTable.text  }}</p>
            </div>
            <p v-if="deliveryTypeDatas[demanda.caracteristicas.caracteristicasTable.entregaMesa]" class="text-whitesmoke f-14 ps-2">
                {{  demanda.caracteristicas.caracteristicasTable.subtext }}
                <span class="text-black ps-1">
                    {{ deliveryTypeDatas[demanda.caracteristicas.caracteristicasTable.mesaDesde] }}
                    min
                    -
                    {{ deliveryTypeDatas[demanda.caracteristicas.caracteristicasTable.mesaHasta] }}
                    min
                </span>
            </p>
            <div v-else class="d-middle mb-4">
                <i class="icon-alerta text-orange f-25" />
                <p class="text-whitesmoke f-14">{{ demanda.caracteristicas.caracteristicasTable.textAdvertence }}</p>
            </div>
        </article>
    </div>
</template>

<script setup>
import tablaTiendaDeDomicilios from '../partials/tablaTiendaDeDomicilios.vue';
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

let route = useRoute()
let router = useRouter()

onMounted(() => {
    getValuesEndPoint()
})

const tablaDeDomiciliosInformacion = ref([
    {
        rangeStart: '0 m ',
        rangeEnd: '100m',
        valueDomicilio: '0',
        pedidoMinimo: 'No aplica',
        timeStart: '20 min',
        timeEnd: '40 min',
        lastMounths: '10'
    },
    {
        rangeStart: '100 m',
        rangeEnd: '500 m',
        valueDomicilio: '5.000',
        pedidoMinimo: '40.000',
        timeStart: '30 min',
        timeEnd: '50 min',
        lastMounths: '20'
    },
    {
        rangeStart: '500 m',
        rangeEnd: '1000 m',
        valueDomicilio: '7.000',
        pedidoMinimo: '100.000',
        timeStart: 'min',
        timeEnd: 'min',
        lastMounths: '0'
    }
])

const tablaDemandaBajaDatas = ref([])
const deliveryTypeDatas = ref({})

const demandas = ref([
    {
        title: 'Demanda baja',
        demanda: 'demandaBaja',
        icon: 'M19.5,5.5V18.5H17.5V5.5H19.5M12.5,10.5V18.5H10.5V10.5H12.5M21,4H16V20H21V4M14,9H9V20H14V9M7,14H2V20H7V14Z',
        color: 'yellow',
        caracteristicas: {
            caracteristicasDomicilio: {
                entregaDomicilio: 'entregaDomicilioBaja',
                icon: 'icon-delivery',
                text: 'Domicilios',
                subtext: 'Valor del domicilio según el rango de distancia',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de Domicilios'
            },
            caracteristicasStore: {
                entregaRecoge: 'entregaRecogeBaja',
                recogeDesde: 'recogeDesdeBaja',
                recogeHasta: 'recogeHastaBaja',
                icon: 'icon-restaurant',
                text: 'Recoger tienda',
                subtext: 'Rango de tiempo en que sus clientes pueden recoger sus órdenes:',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de Recoger tienda'
            },
            caracteristicasTable: {
                entregaMesa: 'entregaMesaBaja',
                mesaDesde: 'mesaDesdeBaja',
                mesaHasta: 'mesaHastaBaja',
                icon: 'icon-table',
                text: 'Servir en mesa',
                subtext: 'Rango de tiempo en que sus clientes recibirán su orden:',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de servir mesa'
            },
        },
    },
    {
        title: 'Demanda media',
        demanda: 'demandaMedia',
        icon: 'M19.5,5.5V18.5H17.5V5.5H19.5M21,4H16V20H21V4M14,9H9V20H14V9M7,14H2V20H7V14Z',
        color: 'orange',
        caracteristicas: {
            caracteristicasDomicilio: {
                entregaDomicilio: 'entregaDomicilioMedia',
                icon: 'icon-delivery',
                text: 'Domicilios',
                subtext: 'Valor del domicilio según el rango de distancia',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de Domicilios'
            },
            caracteristicasStore: {
                entregaRecoge: 'entregaRecogeMedia',
                recogeDesde: 'recogeDesdeMedia',
                recogeHasta: 'recogeHastaMedia',
                icon: 'icon-restaurant',
                text: 'Recoger tienda',
                subtext: 'Rango de tiempo en que sus clientes pueden recoger sus órdenes:',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de Recoger tienda'
            },
            caracteristicasTable: {
                entregaMesa: 'entregaMesaMedia',
                mesaDesde: 'mesaDesdeMedia',
                mesaHasta: 'mesaHastaMedia',
                icon: 'icon-table',
                text: 'Servir en mesa',
                subtext: 'Rango de tiempo en que sus clientes recibirán su orden:',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de servir mesa'
            },
        },
    }
    ,
    {
        title: 'Demanda alta',
        demanda: 'demandaAlta',
        icon: 'M21,4H16V20H21V4M14,9H9V20H14V9M7,14H2V20H7V14Z',
        color: 'red',
        caracteristicas: {
            caracteristicasDomicilio: {
                entregaDomicilio: 'entregaDomicilioAlta',
                icon: 'icon-delivery',
                text: 'Domicilios',
                subtext: 'Valor del domicilio según el rango de distancia',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de Domicilios'
            },
            caracteristicasStore: {
                entregaRecoge: 'entregaRecogeAlta',
                recogeDesde: 'recogeDesdeAlta',
                recogeHasta: 'recogeHastaAlta',
                icon: 'icon-restaurant',
                text: 'Recoger tienda',
                subtext: 'Rango de tiempo en que sus clientes pueden recoger sus órdenes:',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de Recoger tienda'
            },
            caracteristicasTable: {
                entregaMesa: 'entregaMesaAlta',
                mesaDesde: 'mesaDesdeAlta',
                mesaHasta: 'mesaHastaAlta',
                icon: 'icon-table',
                text: 'Servir en mesa',
                subtext: 'Rango de tiempo en que sus clientes recibirán su orden:',
                textAdvertence: 'Esta tienda no tiene habilitado el servicio de servir mesa'
            },
        },
    }
])

async function getValuesEndPoint(){
    let deliveryType = await axios.get(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}/tipos-entrega`)
    deliveryTypeDatas.value = deliveryType.data?.data ?? {}
}

</script>

<style lang="scss" scoped>

</style>