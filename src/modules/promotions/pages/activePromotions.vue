<template>
    <section>
        <header class="d-middle-bt p-4 border-bottom">
            <div class="d-middle gap-2">
                <el-tooltip content="Regresar" placement="bottom" effect="light">
                    <div class="d-middle-center icon-hover-blue rounded-circle cr-pointer wh-32" @click="toGoRouterBack">
                        <i class="icon-chevron-left f-25" />
                    </div>
                </el-tooltip>
                <h1 class="f-bold f-20 mb-0">Promociones activas</h1>
            </div>
            <div class="d-middle gap-4">
                <div class="bg-general cr-pointer py-2 br-8" style="padding: 0 70px 0 70px" @click="createSlider">
                    <p class="text-white f-medium f-14">Crear slider</p>
                </div>
                <div class="border cr-pointer py-2 br-8" style="padding: 0 70px 0 70px" @click="showDrawer = true">
                    <p class="f-medium f-14">Previsualizar</p>
                </div>
            </div>
        </header>
        <main class="d-flex" style="height: calc(100vh - 88px);">
            <div class="border-end p-4 h-100">
                <div class="d-middle position-relative w-288px mb-4">
                    <el-input v-model="searchPromos" @input="searchPromotionsActives" placeholder="Buscar" />
                    <i class="icon-buscar f-25 position-absolute end-0" />
                </div>
                <div v-if="cardInformationPromotions.length" class="h-100 overflow-auto hidden-scroll" style="padding-bottom: 100px;">
                    <boxPromotionsActive v-for="(card, i) in cardInformationPromotions" :key="i" :cardInformation="card" class="mb-2" @moveSlider="moveSliderModal" />
                </div>
                <div v-else class="d-middle-center flex-column h-80 w-298px">
                    <img src="/img/emptyState/woPromos.png" alt="vacioPromos" class="wh-200">
                    <p class="text-grey-light f-15">No hay promociones activas</p>
                </div>
            </div>
            <div class="w-100 h-100 overflow-auto hidden-scroll ps-4 pt-3" style="padding-bottom: 100px; margin-right: 85px;">
                <draggable v-if="sliderSizeInformation.length" v-model="sliderSizeInformation" tag="div" handle=".handle" item-key="id" class="d-flex gap-2">
                    <template #item="{ element, index }">
                        <box-slider-size :informationSliderSize="element" @sizeEdit="sizeEditModal" @deleteSlider="deleteSliderModal" @moveSilderOpenModal="moveSliderModal" />
                    </template>
                </draggable>
                <div v-else >
                    <p class="text-grey-light f-15">No hay silders creados</p>
                </div>
            </div>
        </main>
        <el-drawer v-model="showDrawer" :show-close="false" size="390">
            <template #header>
                <div class="d-middle-bt px-4 py-3" style="box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);;">
                    <p class="f-bold text-blue-dark f-20">Previsualización</p>
                    <i class="icon-close-2 cr-pointer f-25" @click="showDrawer = false" />
                </div>
            </template>
            <template #default>
                <div class="h-100 d-middle-center">
                    <img src="/img/trash/imagePrevisualizacionCellphone.png" alt="imagePrevizualisacion">
                </div>
            </template>
        </el-drawer>
    </section>
    <modalCreateSlider ref="refModalSlider" />
    <modalSliderMoveTo ref="refModalMoveSlider" />
    <modal ref="refModalDeleteSlider" modalTitle="Eliminar slider" action="Eliminar" >
        <div class="ps-3 pe-5 py-4">
            <p class="f-light f-14">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import modalSliderMoveTo from '../partials/modalSliderMoveTo.vue';
import boxSliderSize from '../components/boxSliderSize.vue'
import modalCreateSlider from '../partials/modalCreateSlider.vue';
import boxPromotionsActive from '../components/boxPromotionsActive.vue';
import { useRouter } from 'vue-router';
import { ref } from 'vue';

let router = useRouter()
const searchPromos = ref('')
const showDrawer = ref(false)
const refModalMoveSlider = ref()
const refModalSlider = ref()
const refModalDeleteSlider = ref()


const sliderSizeInformation = ref([
    {
        slider: 'Slider 1',
        size: 'Tamaño grande',
        stateSwitch: 1,
        cardInformationSlider: [
            {
                size: 'Tamaño grande',
                image: '/img/trash/imagePromoBurguer.png',
                promo: 'Super restaurantes',
                type: 'destacados',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
            {
                size: 'Tamaño grande',
                image: '/img/trash/imagePromoBurguer.png',
                promo: 'It´s sushi time',
                type: 'Descuento de porcentaje',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
        ]
    },
    {
        slider: 'Slider 2',
        size: 'Tamaño mediano',
        stateSwitch: 0,
        cardInformationSlider: [
            {
                size: 'Tamaño mediano',
                image: '/img/trash/imagePromoBurguer.png',
                promo: 'Aniversario mexicano',
                type: 'precio fijo',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
            {
                size: 'Tamaño mediano',
                image: '/img/trash/imagePromoBurguer.png',
                promo: 'Festival del pollo',
                type: 'Descuento de un valor',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
            {
                size: 'Tamaño mediano',
                image: '/img/trash/imagePromoBurguer.png',
                promo: '¿Espacio para el postre?',
                type: 'precio fijo',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
        ]
    },
    {
        slider: 'Slider 3',
        size: 'Tamaño pequeño',
        stateSwitch: 1,
        cardInformationSlider: [
            {
                size: 'Tamaño mediano',
                image: '/img/trash/imagePromoBurguer.png',
                promo: 'AL FIN JUERNES',
                type: 'Domicilios',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
            {
                size: 'Tamaño mediano',
                image: '/img/trash/imagePromoBurguer.png',
                promo: 'Tus combos -$2.000',
                type: 'Cambio de valor',
                fechaDesde: '3 ago. 2022',
                fechaHasta: '8 ago. 2022'
            },
        ]
    },
])

const cardInformationPromotions = ref([
    {
        image: '/img/trash/imagePromoBurguer.png',
        promo: 'Todo a 10k',
        type: 'precio fijo',
        fechaDesde: '3 ago. 2022',
        fechaHasta: '8 ago. 2022'
    },
    {
        image: '/img/trash/imagePromoBurguer.png',
        promo: 'Para compartir en familia',
        type: 'descuento en valor',
        fechaDesde: '1 ago. 2022',
        fechaHasta: '7 ago. 2022'
    },
    {
        image: '/img/trash/imagePromoBurguer.png',
        promo: 'No importa donde estés',
        type: 'Domicilio gratis',
        fechaDesde: '5 ago. 2022',
        fechaHasta: '10 ago. 2022'
    },
    {
        image: '/img/trash/imagePromoBurguer.png',
        promo: 'Llegó el juernes',
        type: 'Domicilio gratis',
        fechaDesde: '5 ago. 2022',
        fechaHasta: '10 ago. 2022'
    },
])

const cardInformationPromotionsSearch = ref(cardInformationPromotions.value)

function deleteSliderModal(){
    refModalDeleteSlider.value.open()
}

function sizeEditModal(){
    refModalSlider.value.open()
}

function moveSliderModal(){
    refModalMoveSlider.value.open()
}

function searchPromotionsActives(){
    cardInformationPromotions.value = cardInformationPromotionsSearch.value.filter((element) => element.promo.toLowerCase().includes(searchPromos.value.toLocaleLowerCase()))
}

function createSlider(){
    refModalSlider.value.open()
}


function toGoRouterBack(){
    router.push({ name: 'promotions.groups' })
}

</script>

<style lang="scss" scoped>

</style>