<template>
    <section class="p-5 h-100 overflow-auto hidden-scroll">
        <div class="d-middle-bt">
            <h1 class="f-bold f-28">Promociones</h1>
            <div class="d-middle gap-3">
                <div class="border cr-pointer br-8 px-5 py-2" @click="toGoRoutePromotions('promotions.active.promotions')">
                    <p class="f-medium f-14">Promociones activas</p>
                </div>
                <el-tooltip content="Historial" placement="bottom" effect="light">
                    <div class="border cr-pointer br-8" @click="toGoRoutePromotions('promotions.history')">
                        <i class="icon-historial f-25" />
                    </div>
                </el-tooltip>
            </div>
        </div>
        <div class="d-middle-bt flex-wrap gap-2 mt-4" style="margin-bottom: 70px;">
            <div class="d-middle gap-4 vm-401px">
                <h2 class="f-bold mb-0 f-20">Grupos de promociones</h2>
                <div class="bg-general cr-pointer px-5 br-8" style="padding: 7px 0px 7px 0px;" @click="buttonCreate"><p class="text-white f-14">Crear</p></div>
            </div>
            <div class="d-middle position-relative w-316px">
                <el-input v-model="search" placeholder="Buscar" />
                <i class="icon-buscar f-25 position-absolute end-0 me-1"  />
            </div>
        </div>
        <draggable v-if="informationPromotions.length"  v-model="informationPromotions" tag="div" handle=".handle" item-key="id">
            <template #item="{ element, index }" >
                <div class="d-middle gap-1 mb-3" @click="toGoPromotionBox(element.id)">
                    <i class="icon-dragable f-25 op-02 handle" />
                    <div class="boxHover cr-pointer d-middle-bt border flex-wrap w-100 p-4 br-8">
                        <p class="f-medium f-18 w-50 wm-318px">{{ element.text }}</p>
                        <div class="d-middle-bt w-50">
                            <div class="d-middle">
                                <i class="icon-promo f-25" />
                                <p>{{ element.promo }}</p>
                            </div>
                            <p class="f-medium f-16">Promociones activas: 2</p>
                            <state-box :state-content="element.state" />
                            <el-dropdown>
                                <template #default>
                                    <div class="icon-hover-blue rounded-circle d-middle-center wh-32">
                                        <i class="icon-dots-vertical f-25" />
                                    </div>
                                </template>
                                <template #dropdown>
                                    <el-dropdown-menu class="w-146px">
                                        <el-dropdown-item class="px-2">
                                            <div class="icon-hover-blue w-100 ps-3 py-1 br-4" @click="editDropdown(element.id)">
                                                <p class="f-15">Editar</p>
                                            </div>
                                        </el-dropdown-item>
                                        <el-dropdown-item class="px-2" v-if="element.active">
                                            <div class="icon-hover-blue w-100 ps-3 py-1 br-4" @click="inactiveDropdown(element.active)">
                                                <p class="f-15">Inactivar</p>
                                            </div>
                                        </el-dropdown-item>
                                        <el-dropdown-item class="px-2" v-else>
                                            <div class="icon-hover-blue w-100 ps-3 py-1 br-4" @click="activateDropdown">
                                                <p class="f-15">Activar</p>
                                            </div>
                                        </el-dropdown-item>
                                        <el-dropdown-item class="px-2">
                                            <div class="icon-hover-blue w-100 ps-3 py-1 br-4" @click="deleteDropdown">
                                                <p class="f-15">Eliminar</p>
                                            </div>
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </template>
                            </el-dropdown>
                        </div>
                    </div>
                </div>
            </template>
        </draggable>
        <div v-else class="h-80 d-middle-center flex-column gap-2">
            <img src="/img/emptyState/woPromos.png" alt="imageVacio" class="wh-200">
            <p class="f-15 text-grey-light">No hay grupo de promociones creado</p>
        </div>
    </section>
    <modal ref="refModalPromotionsGroup" :modal-title="titleModalCreateAndEdit">
        <div class="p-4">
            <p class="f-medium f-16 ps-3">Nombre del grupo</p>
            <el-input v-model="inputNameCreate" placeholder="Nombre" />
        </div>
    </modal>
    <modal ref="refModalInactive" modal-title="Inactivar grupo de promociones" action="Inactivar" @buttonAction="inactiveGroupPromotions">
        <div class="px-3 py-4">
            <p class="f-light f-14">Todas las promociones que se encentren en este grupo quedarán inactivas. ¿Seguro de que quieres hacerlo?</p>
        </div>
    </modal>
    <modal ref="refModalActivate" modal-title="Activar grupo de promociones" action="Activar" @buttonAction="activatePromotionsGroup">
        <div class="px-3 py-4">
            <p class="f-light f-14">Podrás activar las promociones que se encentren en este grupo. ¿Seguro de que quieres hacerlo?</p>
        </div>
    </modal>
    <modal ref="refModalDelete" modal-title="Eliminar grupo de promociones" action="Eliminar">
        <div class="py-4 px-3">
            <p class="f-light f-14">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import stateBox from '../../restaurants/components/stateBox.vue';
import { computed, ref } from 'vue';
import { useRouter } from 'vue-router';

const refModalPromotionsGroup = ref()
const refModalDelete = ref()
const refModalInactive = ref()
const refModalActivate = ref()
const titleModalCreateAndEdit = ref('')
const inputNameCreate = ref('')
const search = ref('')
const saveNumberGroupPromotionsActivate = ref(null)

let router = useRouter()

let props = defineProps({
    modelValue:{
        type: Array,
        required: false,
        default: () => []
    }
})

let emit = defineEmits(['update:modelValue'])
let informationPromotionss = props.modelValue

let informationPromotions = computed({
    get(){
        return props.modelValue
    },
    set(newValue){
        emit('update:modelValue', newValue)
    }
})

function buttonCreate(){
    titleModalCreateAndEdit.value = 'Crear grupo de promociones'
    if(inputNameCreate.value !== ''){
        inputNameCreate.value = ''
    }
    refModalPromotionsGroup.value.open()
}

function deleteDropdown(){
    refModalDelete.value.open()
}

function activateDropdown(){
    refModalActivate.value.open()
}

function inactiveDropdown(active){
    saveNumberGroupPromotionsActivate.value = active
    refModalInactive.value.open()
}

function editDropdown(id){
    titleModalCreateAndEdit.value = 'Editar grupo de promociones'
    let findName = props.modelValue.find((element) => element.id === id)
    inputNameCreate.value = findName.text
    refModalPromotionsGroup.value.open()
}

function activatePromotionsGroup(){
    refModalActivate.value.close()
}

function inactiveGroupPromotions(){
    refModalInactive.value.close()
}

function toGoRoutePromotions(nameRoute){
    router.push({ name: nameRoute })
}

function toGoPromotionBox(id){
    router.push({ name: 'promotions.groups.box', params: { id: id} })
}

</script>

<style lang="scss" scoped>
.boxHover{
    transition: background-color 0.3s ease;
    &:hover{
        background-color: var(--blue-lightest);
    }
}

</style>