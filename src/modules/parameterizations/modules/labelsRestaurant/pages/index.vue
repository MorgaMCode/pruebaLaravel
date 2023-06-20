<template>
    <div class="px-5 pt-5 w-100 overflow-auto hidden-scroll">
        <info-top-config
            subtitle="Etiquetas de restaurantes"
            description="Crea etiquetas para optimizar la búsqueda de los restaurantes según palabras clave"
        />
        <div class="d-flex gap-3 my-4">
            <el-input v-model="labelName" @input="seeInputValue" placeholder="Etiqueta de restaurante" style="width: 316px !important" />
            <button-action @open="crear" :attribute="enabled" :opacidad="{ 'op-05': opaqueState() }" />
        </div>
        <template v-if="optionsRestaurant.length">
            <div v-for="option in optionsRestaurant" :key="option.id">
                <enableAndDisableOptions
                    :name="option.nombre"
                    :seeAmount="option.contarOrdenes"
                    :seeId="option.id"
                    @openModalDelete="deleteModal(option.id)"
                    :executeGetDatas="getDatasMotivosRechazo"
                >
                    <template #buttonSwitch>
                        <el-tooltip :content="`${ option.estado ? 'Inactivar' : 'Activar' }`" placement="bottom" effect="light">
                            <el-switch
                                v-model="option.estado"
                                @change="changeSwitch(option.id, option.estado)"
                                style="--el-switch-on-color: #29D884;"
                                :active-value="1"
                                :inactive-value="0"
                            />
                        </el-tooltip>
                    </template>
                </enableAndDisableOptions>
            </div >
        </template>
        <p v-else class="f-15">No hay etiquetas de restaurantes creadas.</p>
    </div>
    <!-- Modal de eliminar etiqueta -->
    <modal
        ref="openModalTagDelete"
        modal-title="Eliminar etiqueta"
        action="Eliminar"
        @button-action="deleteRestaurantObject"
    >
        <template #default>
            <p class="f-14 px-3 pe-4">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
        </template>
    </modal>
</template>

<script setup>
import modal from '../../../../../shared/components/modal.vue';
import infoTopConfig from '../../../../../shared/components/infoTopConfig.vue';
import buttonAction from '../../../../../shared/components/buttonAction.vue'
import buttonSwitch from '../../../../../shared/components/buttonSwitch.vue';
import enableAndDisableOptions from '../../../components/enableAndDisableOptions.vue';
import { ref, onMounted } from 'vue';
import axios from "axios";

const labelName = ref('')
const openModalTagDelete = ref()
const optionsRestaurant = ref([])
const enabled = ref(false)
let idiRestaurant = null


onMounted(() => {
    getDatasMotivosRechazo()
})

async function changeSwitch(idi, state){
    let siwtch = await axios.put(`api/parametrizacion/motivos-rechazo/${idi}/estado`, { estado: state })
}

function deleteModal(id){
    idiRestaurant = id
    openModalTagDelete.value.open()
}
// funcion que se ejecuta cuando escribe algo en el texto
function seeInputValue(){
    const newDatas = optionsRestaurant.value.map((e) => e.nombre)
    if(newDatas.includes(labelName.value)){
        enabled.value = true
    }else{
        enabled.value = false
    }
}

function opaqueState(){
    if(labelName.value == '' || enabled.value == true){
        return true
    }else{
        return false
    }
}

async function deleteRestaurantObject(){
    let seeDelete = await axios.delete(`api/parametrizacion/motivos-rechazo/${idiRestaurant}`)
    getDatasMotivosRechazo()
    openModalTagDelete.value.close()
}


async function crear(){
    if(labelName.value === ''){
        return
    }else{
        let datas = await axios.post("api/parametrizacion/motivos-rechazo", { nombre: labelName.value, tipo: 22 })
        getDatasMotivosRechazo()
    }
    labelName.value = ''
}


async function getDatasMotivosRechazo(){
    let res = await axios.get("api/parametrizacion/motivos-rechazo")
    optionsRestaurant.value = res.data?.data ?? []
}

</script>

<style lang="scss" scoped>
</style>