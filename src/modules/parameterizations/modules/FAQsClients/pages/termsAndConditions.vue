<template>
    <div class="mt-3">
        <buttonAction button-content="Crear sección" @open="toGoCreate" />
        <draggable v-model="datasCollapse" tag="div" handle=".handle" item-key="id" @change="changeDraggable" >
            <template #item="{ element, index }">
                <main class="d-flex mt-4">
                    <i class="icon-dragable handle f-23 op-02" />
                    <main style="width: 544px !important;">
                        <div class="d-middle-bt px-2 py-1 br-8 box-shadowBox">
                            <div
                                class="d-middle cr-pointer"
                                data-bs-toggle="collapse"
                                :href="`#multiCollapseExample${index}`"
                                @click="collapse(index)"
                            >
                                <p class="f-16 f-semibold mb-0">{{ element.titulo }}</p>
                                <i v-if="seeValues(index)" class="icon-chevron-up f-23" />
                                <i v-else class="icon-chevron-down f-23" />
                            </div>
                            <div class="d-middle">
                                <icon-actions @deleteTag="openDeleteModal(element.id)" @removeIcons="openModalEdit(element.id)" />
                                <el-tooltip :content="element.estado ? 'Inactivar' : 'Activar'" placement="bottom" effect="light">
                                    <el-switch
                                        v-model="element.estado"
                                        :active-value="1"
                                        :inactive-value="0"
                                        style="--el-switch-on-color: #13ce66;"
                                        @change="switchButton(element.id, element.estado)"
                                    />
                                </el-tooltip>
                            </div>
                        </div>
                        <div class="mt-3 ms-2 collapse" :id="`multiCollapseExample${index}`" >
                            <p>{{ element.texto }}</p>
                            <p class="f-14 f-medium text-blue-dark">{{ element.subtitle }}</p>
                            <p class="f-14 f-light">{{  element.contentText }}</p>
                            <p class="mt-3 f-11 f-bold text-whitesmoke">Creado: <span class="f-11 f-light text-whitesmoke ps-1">{{ element.creador }} - {{ element.creado }}</span></p>
                            <p class="f-11 f-bold text-whitesmoke">Actualizado: <span class="f-11 f-light text-whitesmoke ps-1">{{ element.actualizador }} - {{ element.actualizado }}</span></p>
                        </div>
                    </main>
                </main>
            </template>
        </draggable>
        <modal ref="openRemoveModal" modal-title="Eliminar sección" action="Eliminar" @buttonAction="removeCollapse">
            <p class="f-14 px-3">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
        </modal>
    </div>
</template>

<script setup>
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import iconActions from '../../../../../shared/components/iconActions.vue';
import buttonSwitch from '../../../../../shared/components/buttonSwitch.vue';
import modal from '../../../../../shared/components/modal.vue';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const openRemoveModal = ref()
const id = ref(null)
const arrowDown = ref({})
const elementsOpens = ref([])
const identifier = ref(null)
let router = useRouter()

onMounted(() => {
    getDataTermsAndConsitions()
})

function seeValues(index){
    return elementsOpens.value.includes(index)
}

const datasCollapse = ref([])

function openModalEdit(id){
    router.push({ path: `terminos_y_condiciones/editar/${id}` })
}

function toGoCreate(){
    router.push({ name: 'parameterization.faqsClients.termsAndConditions.create' })
}

function collapse(index){
    setTimeout(() => {
        id.value = document.getElementById(`multiCollapseExample${index}`).className
        if(id.value.includes('show')){
            elementsOpens.value.push(index)
        }
        else{
            elementsOpens.value =  elementsOpens.value.filter(e => e != index)
        }
    }, 400)
}

async function changeDraggable(){
    let datasPosition = datasCollapse.value.map((p, index) => {
        return{
            id: p.id,
            posicion: index + 1
        }
    })
    let updatePosition = await axios.put("api/parametrizacion/terminos-condiciones/posicion", {terminos: datasPosition})
}

async function switchButton(id, state){
    let changeState = await axios.put(`api/parametrizacion/terminos-condiciones/${id}/estado`, { estado: state })
    console.log();
}

function openDeleteModal(identificador){
    openRemoveModal.value.open()
    identifier.value = identificador
}
async function removeCollapse(){
    let deleteModal = await axios.delete(`api/parametrizacion/terminos-condiciones/${identifier.value}`)
    getDataTermsAndConsitions()
    openRemoveModal.value.close()
}

async function getDataTermsAndConsitions(){
    let params = { destino: 2, tipo: 2 }
    let datas = await axios.get('api/parametrizacion/terminos-condiciones', {params})
    datasCollapse.value = datas.data?.data ?? []
}
</script>

<style lang="scss" scoped>

</style>