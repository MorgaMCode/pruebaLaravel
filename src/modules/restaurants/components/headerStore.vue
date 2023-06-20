<template>
    <div class="h-65px d-middle-bt py-3 px-4" style="box-shadow: 0px 1px 2px var(--shadow);">
        <div class="d-middle gap-3">
            <el-tooltip v-if="showArrow" content="Lista de tiendas" placement="bottom" effect="light">
                <div class="wh-32 icon-hover-blue d-middle-center rounded-circle cr-pointer" style="transition: .3s;" @click="emit('toGoRouteBack')">
                    <i class="icon-arrow-left f-24" />
                </div>
            </el-tooltip>
            <p class="f-28 f-bold">{{ menuFixed?.nombre ? menuFixed?.nombre : menuFixed?.tienda }}</p>
        </div>
        <div class="d-middle-center gap-2">
            <template class="d-middle" v-if="menuFixed?.calificacion">
                <img src="/img/emptyState/calificación.png" alt="fotoLogoMini" class="wh-28" />
                <p class="starCalification cr-pointer f-20 f-semibold" @click="emit('seeModalClassification')">{{ menuFixed.calificacion }}<span class="f-14 f-light">({{ menuFixed.calificacionCantidad }})</span></p>
            </template>
            <stateBox :state-content="menuFixed?.estado" />
            <cardObservations v-if="menuFixed?.tieneObservacion !== 0" @open-observations="emit('openModalObservations')" />
            <el-tooltip content="Historial de estados" placement="bottom" effect="light">
                <div class="wh-32 rounded-circle icon-hover-blue d-middle-center cr-pointer" style="transition: .3s;" @click="emit('toGoRouteHistory')">
                    <i class="icon-historial f-22" />
                </div>
            </el-tooltip>
            <el-dropdown>
                <div class="wh-36 rounded-circle blue-item d-middle-center" style="transition: .3s">
                    <i class="icon-dots-vertical f-26" />
                </div>
                <template #dropdown>
                <el-dropdown-menu class="w-196px">
                    <el-dropdown-item v-if="show" class="px-2">
                        <div class="icon-hover-blue br-4 px-3 py-1 w-100" @click="emit('restaurantActive')">
                            <p class="f-15">Activar</p>
                        </div>
                    </el-dropdown-item>
                    <el-dropdown-item v-else class="px-2">
                        <div class="icon-hover-blue br-4 px-3 py-1 w-100" @click="emit('restaurantInactive')">
                            <p class="f-15">Inactivar</p>
                        </div>
                    </el-dropdown-item>
                    <el-dropdown-item class="px-2">
                        <div class="icon-hover-blue br-4 px-3 py-1 w-100" @click="emit('deleteRestaurant')">
                            <p class="f-15">Eliminar restaurantes</p>
                        </div>
                    </el-dropdown-item>
                </el-dropdown-menu>
                </template>
            </el-dropdown>
        </div>
    </div>
</template>

<script setup>
import stateBox from './stateBox.vue';
import modalClassification from '../partials/modalClassification.vue';
import cardObservations from './cardObservations.vue';
import { useRoute, useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

let route = useRoute()
let router = useRouter()
const show = ref(true)
const informationObervation = ref()
const modalStateBoxInformation = ref({})

let emit = defineEmits(['toGoRouteBack', 'toGoRouteHistory', 'restaurantActive', 'restaurantInactive', 'deleteRestaurant', 'openModalObservations', 'seeModalClassification'])

let props = defineProps({
    menuFixed: {
        type: Object,
        required: false,
        default: () => {}
    },
    showArrow:{
        type: Boolean,
        required: false,
        default: false
    }
})

async function activate(){
    let changeState = await axios.post(`api/restaurantes/${28}/estado`, { estado: 42 })
    show.value = !show.value
    activateRestaurant.value.close()
}

defineExpose({
    activate
})
</script>

<style lang="scss" scoped>
.starCalification{
    &:hover{
        color: #0052CC;
        text-decoration: underline;
    }
}

</style>