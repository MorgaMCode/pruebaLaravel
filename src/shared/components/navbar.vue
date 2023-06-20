<template>
    <div class="w-100 h-56px box-shadow29 py-2 px-4 d-middle-bt">
        <div class="d-middle text-blue-dark gap-2">
            <img src="/img/trash/imageHooy.png" alt="image">
            <div class="d-middle gap-3 ps-4">
                <template v-for="(select, i) in selectsTop" :key="i">
                    <el-popover
                        placement="bottom"
                        trigger="click"
                        width="255"
                        @before-enter="openPopoverLeft(true, i)"
                        @after-leave="openPopoverLeft(false, i)"
                        :auto-close="5"
                    >
                        <template #reference>
                            <el-badge :value="select.notificaciones" :max="99">
                                <div
                                    class="hoverLineBlue d-middle border-white cr-pointer rounded-pill pe-1 ps-1"
                                    :class="{
                                        'alturaBorderImage': select.image,
                                        'anchoCentroAyuda': select.icon,
                                        'borderBlueLightest': popoverActivoLeft(i),
                                        'fondoAzulActive': fondoAzulActiveLeft(i)
                                    }"
                                >
                                    <div v-if="select.icon" class="d-middle-center wh-24 ps-2">
                                        <i class="icon-support f-25" />
                                    </div>
                                    <div v-if="select.image" class="wh-30">
                                        <img src="/img/trash/alRock.png" alt="imageAlRock" class="wh-30 rounded-circle" />
                                    </div>
                                    <p class="f-14 ps-2" :class="{ 'text-blue': select.image }">{{ select.text }}</p>
                                    <template v-if="select.icon !== true">
                                        <div class="d-middle-center wh-20 me-1" :class="[ popoverActivoLeft(i) ? 'spinArrow': 'returnArrow' ]">
                                            <i class="icon-chevron-down f-20" />
                                        </div>
                                    </template>
                                </div>
                            </el-badge>
                        </template>
                        <template #default>
                            <template v-if="i === 0">
                                <div v-for="admin in desplegableAdministracionInfo" class="icon-hover-blue cr-pointer w-223px br-4 ps-2 py-1" style="transition: .3s all;">
                                    <div class="d-middle gap-2">
                                        <img :src="admin.image" alt="" class="wh-39" />
                                        <div>
                                            <p class="text-black f-14">{{ admin.nombre }} ({{ admin.mount }})</p>
                                            <p class="text-grey-light f-12">{{ admin.tipo }}</p>
                                            <p class="f-light f-12" :class="colorLetters(admin.state)">{{ admin.state }}</p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-if="i !== 0">
                                <ordenesOpciones v-for="(operaciones, index) in desplegableOperacionesInfoArrow" :key="index" :option="operaciones">
                                    <template #optionsDesplegable>
                                        <div
                                            v-for="(option, i) in operaciones.options"
                                            :key="i"
                                            class="icon-hover-blue cr-pointer br-4 py-1 ps-3"
                                            :class="{ 'bg-blue-state-lightest': identificarRutaTablero(i, index, select.id) }"
                                            @click="irARutasOrdenes(i)"
                                        >
                                            <p class="f-15">{{ option.text }}</p>
                                        </div>
                                        <div v-if="desplegableOperacionesInfoArrow[desplegableOperacionesInfoArrow.length - 1] !== operaciones" class="w-100 my-2 h-2px" style="background-color: #efefef;" />
                                    </template>
                                </ordenesOpciones>
                            </template>
                        </template>
                    </el-popover>
                </template>
            </div>
        </div>
        <div class="d-middle gap-4 section-rigth">
            <div class="d-middle border-start border-end px-4 gap-4">
                <template v-for="(orden, i) in ordenesTop">
                    <el-badge :value="orden.notificaciones" :max="99" :class="{ 'border-start ps-4 ms-2': orden.state === 6 }">
                        <el-popover placement="bottom" trigger="click" width="241" @before-enter="openPopoverRight(true, i)" @after-leave="openPopoverRight(false, i)" :disabled="orden.state === 6" >
                            <template #reference>
                                <div>
                                    <el-tooltip :content="iconsOrdenes[orden.state].text" placement="bottom" effect="light" >
                                        <div
                                            class="d-middle-center border-blue-lightest rounded-circle position-relative cr-pointer item-with-hover wh-40"
                                            :class="{ 'bg-blue-state-lightest': fondoAzulActiveRight(i) }"
                                        >
                                            <i class="f-25" :class="iconsOrdenes[orden.state].icon" />
                                        </div>
                                    </el-tooltip>
                                </div>
                            </template>
                            <template #default>
                                <ordenesOpciones v-for="(operacion, i) in desplegableOperacionesInfo" :key="i" :option="operacion">
                                    <template #optionsDesplegable>
                                        <div v-for="(option, i) in operacion.options" :key="i" class="icon-hover-blue d-middle-bt cr-pointer br-4 py-1 px-3">
                                            <p class="f-15">{{ option.text }}</p>
                                            <p v-if="option.monto === null" class="">-</p>
                                            <p v-else class="f-15">{{ option.monto }}</p>
                                        </div>
                                        <div v-if="desplegableOperacionesInfo[desplegableOperacionesInfo.length - 1] !== operacion" class="w-100 my-2 h-2px" style="background-color: #efefef;" />
                                    </template>
                                </ordenesOpciones>
                            </template>
                            </el-popover>
                    </el-badge>
                </template>
            </div>
            <div class="d-middle-center text-white bg-orange rounded-circle cr-pointer wh-40">
                <i class="icon-account f-24" />
            </div>
        </div>
    </div>
</template>

<script setup>
import ordenesOpciones from './ordenesOpciones.vue';
import { ref, onMounted, watch, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const identificarFlecha = ref([])
const identificarFondo = ref([])
const identificarFondoRight = ref([])
const identificarOrdenes = ref(false)
const identificarRutaOrdenesTablero = ref(false)
const identificarRutaOrdenes = ref(false)

let route = useRoute()
let router = useRouter()

onMounted(() => {
    if(route.name.includes('orders')) identificarFondo.value.push({ nameRoute: 'orders', number: 2 })
    if(route.name.includes('orders.board')) identificarRutaOrdenesTablero.value = true;
    if(route.name.includes('orders.actives')) identificarRutaOrdenes.value = true;
})

watch(
    () => route.name.includes('orders'),
    (newValue) => {
        if(newValue){
            identificarFondo.value.push({ nameRoute: 'orders', number: 2 })
        }else{
            identificarFondo.value = identificarFondo.value.filter((ele) => ele.nameRoute !== 'orders')
        }
    }
)
watch(
    () => route.name.includes('orders.board'),
    (newValue) => {
        if(newValue){
            identificarRutaOrdenesTablero.value = newValue
        }else{
            identificarRutaOrdenesTablero.value = newValue
        }
    }
)

watch(
    () => route.name.includes('orders.actives'),
    (newValue) => {
        if(newValue){
            identificarRutaOrdenes.value = newValue
        }else{
            identificarRutaOrdenes.value = newValue
        }
    }
)

const iconsOrdenes = {
    1: { icon: 'icon-orders-outline', text: 'Ordenes por aceptar' },
    2: { icon: 'icon-cooking', text: 'Ordenes en preparación' },
    3: { icon: 'icon-delivery', text: 'Ordenes en camino' },
    4: { icon: 'icon-box-delivery', text: 'Ordenes por entregar' },
    5: { icon: 'icon-dish', text: 'Ordenes por servir' },
    6: { icon: 'icon-soporte-1', text: 'Soporte' },
}

const ordenesTop = ref([
    { notificaciones: 16, state: 1 },
    { notificaciones: 100, state: 2 },
    { notificaciones: 3, state: 3 },
    { notificaciones: 9, state: 4 },
    { notificaciones: 80, state: 5 },
    { notificaciones: 10, state: 6 },
])

const selectsTop = ref([
    { id: 1, text: 'Administración' },
    { id: 2, text: 'Operaciones' },
    { id: 3, text: 'Órdenes', image: true },
    { id: 4, text: 'Centro de ayuda', icon: true, notificaciones: 2},
])

const desplegableOperacionesInfo = ref([
    {
        img: '/img/trash/jarris.png',
        text: 'Ketaco',
        tipo: 'Mexicana',
        options: [
            { text: 'Megamall', monto: 12 },
            { text: 'Cacique', monto: null },
            { text: 'Caracoli', monto: 5 },
            { text: 'La florida', monto: 1 },
        ]
    },
    {
        img: '/img/trash/jarris.png',
        text: 'Al Rock Burger',
        tipo: 'Hamburguesas',
        options: [
            { text: 'Provenza', monto: 1 },
        ]
    }
])

const desplegableOperacionesInfoArrow = ref([
    {
        img: '/img/trash/jarris.png',
        text: 'Ketaco',
        tipo: 'Mexicana',
        options: [
            { text: 'Megamall' },
            { text: 'Cacique' },
            { text: 'Caracoli' },
            { text: 'La florida' },
        ]
    },
    {
        img: '/img/trash/jarris.png',
        text: 'Al Rock Burger',
        tipo: 'Hamburguesas',
        options: [
            { text: 'Provenza' },
        ]
    }
])

const desplegableAdministracionInfo = ref([
    { image: '/img/trash/jarris.png', nombre: 'Ketaco', mount: 2, tipo: 'Mexicana', state: 'Nuevo' },
    { image: '/img/trash/jarris.png', nombre: 'Al rock burger', mount: 1, tipo: 'Hamburguesas', state: 'Activo' },
    { image: '/img/trash/jarris.png', nombre: 'BATTUTO', mount: 4, tipo: 'Comida rapida', state: 'Reenviado' },
    { image: '/img/trash/jarris.png', nombre: 'Don lucho', mount: 4, tipo: 'Comida Tipica', state: 'Revisión' },
    { image: '/img/trash/jarris.png', nombre: 'Al rock burger', mount: 2, tipo: 'Hamburguesas', state: 'Rechazado' },
    { image: '/img/trash/jarris.png', nombre: 'Ketaco', mount: 2, tipo: 'Mexicana', state: 'Inactivo Hooy' },
    { image: '/img/trash/jarris.png', nombre: 'BATTUTO', mount: 4, tipo: 'Comida rapida', state: 'Inactivo admin' },
])

function irARutasOrdenes(i){
    if(i === 1 && identificarOrdenes.value){
        router.push({ name: 'orders.board' })
    }else if(i === 0 && identificarOrdenes.value){
        router.push({ name: 'orders' })
    }
}

function identificarRutaTablero(i, index, idSelect){
    if(i === 0 && identificarRutaOrdenes.value && index === 0 && idSelect === 3) return true
    if(i === 1 && identificarRutaOrdenesTablero.value && index === 0 && idSelect === 3) return true
}

function fondoAzulActiveRight(i){
    return identificarFondoRight.value.includes(i)
}

function fondoAzulActiveLeft(i){
    let encontrarValor = identificarFondo.value.find((ele) => ele.number === i)
    return identificarFondo.value.includes(i) || encontrarValor?.nameRoute === 'orders' && encontrarValor?.number === i
}

function popoverActivoLeft(i){
    return identificarFlecha.value.includes(i)
}

function openPopoverRight(boolean, i){
    if(boolean){
        identificarFondoRight.value.push(i)
    }else{
        identificarFondoRight.value = identificarFondoRight.value.filter((ele) => ele !== i)
    }
}

function openPopoverLeft(boolean, index){
    if(boolean){
        identificarFlecha.value.push(index)
        if(index === 2 || index === 3){
            identificarFondo.value.push(index)
        }
        if(index === 2){
            identificarOrdenes.value = true
        }
    }else{
        identificarFlecha.value = identificarFlecha.value.filter((ele) => ele !== index)
        if(index === 2 || index === 3){
            identificarFondo.value = identificarFondo.value.filter((ele) => ele !== index)
        }
        if(index === 2){
            identificarOrdenes.value = false
        }
    }
}

function colorLetters(state){
    if(state.includes('Nuevo')){
        return 'text-blue'
    }else if(state.includes('Reenviado')){
        return 'text-blue'
    }else if(state.includes('Activo')){
        return 'text-green-clear'
    }else if(state.includes('Revisión')){
        return 'text-orange'
    }else if(state.includes('Inactivo')){
        return 'text-whitesmoke'
    }else if(state.includes('Rechazado')){
        return 'text-red'
    }
}
</script>

<style scoped lang="scss">
div{
    z-index: 3;
    position: relative;
    .hoverLineBlue{
        transition: border .3s ease;
        padding: 6px 0px;
        &:hover{
            border: 1px solid var(--blue-state-lightest) !important;
        }
        &.alturaBorderImage{
            padding: 2px;
            border: 1px solid var(--blue-state-lightest) !important;
            color: var(--blue-state);
            transition: background-color .3s ease;
            &:hover{
                background-color: var(--blue-state-lightest);
            }
        }
        &.anchoCentroAyuda{
            padding-right: 20px !important;
            border: 1px solid var(--blue-state-lightest) !important;
            transition: 0.3s all;
            &:hover{
                background-color: var(--blue-state-lightest);
                color: var(--blue-state) !important;
            }
        }
        .spinArrow{
            transition: .5s all;
            transform: rotateZ(-180deg);
        }
        .returnArrow{
            transition: .5s all;
            transform: rotateZ(0deg);
        }
    }
    .fondoAzulActive{
        color: blue !important;
        background-color: var(--blue-state-lightest);
    }
}
.borderBlueLightest{
    border: 1px solid var(--blue-state-lightest) !important;
}
</style>