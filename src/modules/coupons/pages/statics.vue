<template>
    <div class="h-100">
        <header class="h-80px border-bottom gap-2 d-middle px-3">
            <el-tooltip content="Regresar a los detalles" placement="bottom" effect="light" >
                <div class="d-middle-center cr-pointer item-with-hover rounded-circle wh-32" @click="toGoDetails">
                    <i class="icon-chevron-left f-25" />
                </div>
            </el-tooltip>
            <p class="f-18 f-medium">Estadísticas detalladas del cupón</p>
        </header>
        <section class="mx-5 my-4 h-100 overflow-auto hidden-scroll px-1" style="padding-bottom: 100px;">
            <div class="h-80px text-center d-middle-end gap-3">
                <template v-if="datasFilter.length">
                    <dropdown-objects v-model="selectedClasfication" :data="datasFilter[0]" />
                    <dropdown-objects v-model="selectedPlan" :data="datasFilter[1]" />
                    <dropdown-objects v-model="selectedRestaurant" :data="datasFilter[2]" />
                </template>
                <button-action button-content="Filtrar" width="w-112px" @open="seeDropdownSelected" />
                <el-tooltip content="Limpiar filtro" placement="bottom" effect="light">
                    <div class="wh-36 d-middle-centert br-8" style="border: 1px solid var(--gray-light);" @click="cleanFilter" >
                        <i class="icon-undu f-24" />
                    </div>
                </el-tooltip>            </div>
            <statics-partials :value="staticsValues" />
        </section>
    </div>
</template>

<script setup>
import dropdownObjects from '../components/dropdownObjects.vue';
import staticsPartials from '../partials/staticsPartials.vue';
import buttonAction from '../../../shared/components/buttonAction.vue';
import { useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';

const router = useRouter()
const selectedClasfication = ref([])
const selectedPlan = ref([])
const selectedRestaurant = ref([])

const backFilter = ref([
    {
        id: 1,
        text: 'Clasificación',
        dropdownInformation: [
            {
                id: 1,
                text: 'VIP',
                image: '/img/trash/medalVip.png',
            },
            {
                id: 2,
                text: 'Gold',
                image: '/img/trash/medalGold.png',
            },
            {
                id: 3,
                text: 'Silver',
                image: '/img/trash/medalSilver.png',
            },
            {
                id: 4,
                text: 'Diamante',
                image: '/img/trash/medalDiamante.png',
            }
        ]
    },
    {
        id: 2,
        text: 'Plan',
        dropdownInformation: [
            {
                id: 5,
                text: 'Plan #1',
            },
            {
                id: 6,
                text: 'Plan #2'
            },
            {
                id: 7,
                text: 'Plan #3'
            }
        ]
    },
    {
        id: 3,
        text: 'Restaurantes',
        dropdownInformation: [
            {
                id: 8,
                text: 'Macotaco',
                image: '/img/trash/burguer.png',
            },
            {
                id: 9,
                text: 'Juicy burguer',
                image: '/img/trash/backery.png',
            },
            {
                id: 10,
                text: 'El club del asado',
                image: '/img/trash/chicken.png',
            },
            {
                id: 11,
                text: 'Los amigos food',
                image: '/img/trash/emptyTable.png',
            },
            {
                id: 12,
                text: 'Argie asado',
                image: '/img/trash/jarris.png',
            }
        ]
    },
]);

const datasFilter = ref([])

const index = ref(null)
const arrayInside = ref()

onMounted(() => {
    datasFilter.value = backFilter.value
})


const staticsValues = ref([
    {
        id: 1,
        text: 'Cupones aplicados',
        price: '520'
    },
    {
        id: 2,
        text: 'Valor ventas',
        price: '$ 5.200.000'
    },
    {
        id: 2,
        text: 'Valor obsequiado',
        price: '$ 520.000'
    },
    {
        id: 2,
        text: 'Clientes que compraron',
        price: '30'
    },
])

function toGoDetails(){
    router.push({ name: 'coupons.77.main' })
}

const data = [ { text: 'Clasi'}, { text: 'Plans'} ]

function seeDropdownSelected(){
    if(selectedClasfication.value.length || selectedPlan.value.length || selectedRestaurant.value.length){
        selectedClasfication.value.forEach((e) => console.log('Selected clasification: ',e))
        selectedPlan.value.forEach((e) => console.log('Selected plan: ',e))
        selectedRestaurant.value.forEach((e) => console.log('Selected restaurant: ',e))
    }else {
        console.log('no hay nada para filtrar');
    }
}

function cleanFilter(){
    if(selectedClasfication.value.length || selectedPlan.value.length || selectedRestaurant.value.length){
        selectedClasfication.value = []
        selectedPlan.value = []
        selectedRestaurant.value = []
    }else {
        console.log('no hay nada para limpiar');
    }
}

</script>

<style lang="scss" scoped>


</style>