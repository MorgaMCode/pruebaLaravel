<template>
    <div class="overflow-auto hidden-scroll px-5 pb-5 h-100">
        <h1 class="f-medium f-22">Servir en mesa</h1>
        <div v-if="tableInformation.length" class="ps-3">
            <p class="text-whitesmoke mb-3 f-14">Mesas disponibles que sus clientes podran usar para consumir sus ordenes.</p>
            <p class="f-medium f-14">Mesas (3)</p>
            <template v-for="(table, i) in tableInformation" :key="i">
                <div class="tableBox cr-pointer d-middle flex-wrap p-2 br-9 box-shadowBox w-22 my-3" @click="tableCode(table.id, table.estado)">
                    <i class="icon-table f-25" />
                    <p class="f-14 me-auto">{{ table.nombre }}</p>
                    <div @click="changeStateEye(table.id)">
                        <i v-if="table.estado" class="icon-eye f-25" />
                        <i v-else class="icon-hidden f-25" />
                    </div>
                    <number-box :use-number="table.usos" tooltip-content="Usos" />
                </div>
            </template>
        </div>
        <div v-else class="d-middle j-center flex-column h-100">
            <img src="/img/emptyState/woTables.png" alt="mesasVacias" class="wh-200">
            <p class="text-whitesmoke f-14">Esta tienda no ha agregado mesas</p>
        </div>
    </div>
    <modal ref="openModalTableCode" modal-title="Código" :modal-width="299" :see-buttons-bottom="false" >
        <div class="d-flex flex-column a-center gap-2 pt-2 pb-4">
            <p class="f-medium f-14">{{ informationCodeTableModal.nombre }}</p>
            <img :src="saveCodeQR" :alt="informationCodeTableModal.codigo" class="wh-161 text-orange" />
        </div>
    </modal>
</template>

<script setup>
import numberBox from '../../../shared/components/numberBox.vue';
import modal from '../../../shared/components/modal.vue';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import QRcode from 'qrcode'


const openModalTableCode = ref()
let route = useRoute()

onMounted(function(){
    getStoresTables()
})

const tableInformation = ref([])
const informationCodeTableModal = ref({})
const seeEyeModal = ref(false)
const saveCodeQR = ref('')

async function changeStateEye(id){
    seeEyeModal.value = true
    let updateState = await axios.post(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}/mesas/${id}/estado`)
    getStoresTables()
}

function tableCode(id){
    informationCodeTableModal.value = tableInformation.value.find((element) => element.id === id)
    QRcode.toDataURL(informationCodeTableModal.value.codigo, { version: 2 },(error, dataURL) => {
        if(error){
            console.log('Este es el erro asignado: ', error);
        }else{
            saveCodeQR.value = dataURL
        }
    })
    seeEyeModal.value === false ? openModalTableCode.value.open() : seeEyeModal.value = false
}

async function getStoresTables(){
    let tablesStores = await axios.get(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}/mesas`)
    tableInformation.value = tablesStores.data?.data ?? []
}

</script>

<style lang="scss" scoped>
.tableBox{
    transition: background-color 0.3s ease;
    &:hover{
        background-color: var(--blue-lightest);
    }
}

</style>