<template>
    <div class="px-5 pt-5 w-100 overflow-auto hidden-scroll">
        <div class="d-middle gap-2">
            <el-tooltip content="Regresar" placement="bottom" effect="light">
                <div class="item-with-hover rounded-pill cr-pointer f-25" @click="back" >
                    <i class="icon-chevron-left" />
                </div>
            </el-tooltip>
            <h3 class="f-20 f-bold mb-0">{{ route.name == 'parameterization.comissionPlans.createPlan' ? 'Crear': 'Editar' }} plan de comisiones</h3>
        </div>
        <div style="margin-left: 37px;">
            <div class="w-426px mt-4">
                <Form @submit="submitForm" name="myform" id="Createform" :initial-values="{ nombre: informationComissionPlans.nombre, descripcion: informationComissionPlans.descripcion }" >
                    <p class="f-16 f-medium ms-3">Nombre del plan</p>
                    <Field v-slot="{ field, errorMessage }" name="nombre" label="Nombre" rules="required|max:40" >
                        <el-input
                            v-model="informationComissionPlans.nombre"
                            placeholder="Nombre del plan de comisiones"
                            v-bind="field"
                            maxlength="40"
                            class="input-gray-dark w-100"
                        />
                        <p class="text-red f-15">{{ errorMessage }}</p>
                    </Field>
                    <p class="f-16 f-medium ms-3 mt-2">Descripción</p>
                    <Field v-slot="{ field, errorMessage }" name="descripcion" label="Descripcion" rules="required|max:40" >
                        <el-input
                            v-model="informationComissionPlans.descripcion"
                            size="large"
                            type="textarea"
                            v-bind="field"
                            placeholder="Descripción"
                            maxlength="40"
                        />
                        <p class="text-red f-15">{{ errorMessage }}</p>
                    </Field>
                </Form>
            </div>
            <div class="mt-4">
                <p class="f-15 f-medium">Define la comisión que se aplica a este plan</p>
                <el-radio-group v-model="informationComissionPlans.aplicacion">
                    <el-radio :label="1"><p class="f-15">Aplicar comisión mayor</p></el-radio>
                    <el-radio :label="2"><p class="f-15">Aplicar comisión menor</p></el-radio>
                </el-radio-group>
            </div>
            <div class="d-flex mt-4 gap-5">
                <div class="w-50">
                    <p class="f-16 f-medium mb-4">Comisión por venta</p>
                    <div class="d-flex j-between gap-5 w-85 f-16">
                        <p class="ms-3 f-medium">Desde</p>
                        <p class="me-1 f-medium">Hasta</p>
                        <p class="me-1 f-medium">% comisión </p>
                    </div>
                    <template v-for="(comission, index) in informationComissionPlans.comisionValoresVenta" :key="index">
                        <main class="d-flex gap-3 mb-3">
                            <el-input v-model="comission.desde" placeholder="" />
                            <el-input v-model="comission.hasta" placeholder="" />
                            <el-input v-model="comission.comision" placeholder="" />
                            <el-tooltip content="Eliminar" placement="bottom" effect="light">
                                <div class="f-25 item-with-hover rounded-pill">
                                    <i class="icon-eliminar" @click="removeSaleComission(index)" />
                                </div>
                            </el-tooltip>
                        </main>
                    </template>
                    <div class="d-flex gap-3 mb-3">
                        <el-input v-model="saleComissionValue1" placeholder="$" />
                        <el-input v-model="saleComissionValue2" placeholder="$" />
                        <el-input v-model="percentageComissionValue" placeholder="%" />
                        <el-tooltip content="Añadir rango" placement="bottom" effect="light">
                            <div class="f-25 item-with-hover rounded-pill">
                                <i class="icon-add-square" @click="addSaleComission" />
                            </div>
                        </el-tooltip>
                    </div>
                </div>
                <div class="w-50">
                    <p class="f-16 f-medium mb-4">Comisión por orden</p>
                    <div class="d-flex j-between gap-5 w-85 f-16">
                        <p class="ms-3 f-medium">Desde</p>
                        <p class="me-1 f-medium">Hasta</p>
                        <p class="me-1 f-medium">% comisión </p>
                    </div>
                    <template v-for="(orderComission, index) in informationComissionPlans.comisionValoresOrden" :key="index">
                        <main class="d-flex gap-3 mb-3">
                            <el-input v-model="orderComission.desde" placeholder="" />
                            <el-input v-model="orderComission.hasta" placeholder="" />
                            <el-input v-model="orderComission.comision" placeholder="" />
                            <el-tooltip content="Eliminar" placement="bottom" effect="light">
                                <div class="f-25 item-with-hover rounded-pill">
                                    <i class="icon-eliminar" @click="removeComissionOrder(index)" />
                                </div>
                            </el-tooltip>
                        </main>
                    </template>
                    <div class="d-flex gap-3 mb-3">
                        <el-input v-model="valueComissionOrder1" placeholder="Valor" />
                        <el-input v-model="valueComissionOrder2" placeholder="Valor" />
                        <el-input v-model="valueComissionPercentage" placeholder="%" />
                        <el-tooltip content="Añadir rango" placement="bottom" effect="light">
                            <div class="f-25 item-with-hover rounded-pill">
                                <i class="icon-add-square" @click="addComissionOrder" />
                            </div>
                        </el-tooltip>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mt-5">
            <button class="w-140px h-36px br-8 f-14 bg-white me-4" style="border: 1px solid var(--gray-light)" @click="back">Cancelar</button>
            <button-action v-if="route.name == 'parameterization.comissionPlans.createPlan'" typeButton="submit" send-form="Createform" />
            <button-action v-else @open="editComissionPlan" button-content="Editar" />
        </div>
    </div>
</template>

<script setup>
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import { useRouter, useRoute } from 'vue-router';
import {ref, onMounted } from 'vue';
import axios from 'axios';
import { Form, Field } from 'vee-validate';

const route = useRoute()
const router = useRouter()

// Variables que guardan informacion de comision por venta
const saleComissionValue1 = ref('')
const saleComissionValue2 = ref('')
const percentageComissionValue = ref('')
// Variables del input que guardan informacion de comision por orden
const valueComissionOrder1 = ref('')
const valueComissionOrder2 = ref('')
const valueComissionPercentage = ref('')
// Estas tres variables
const radio = ref(1)
// variable que guarda la informacion sacada del array con el metodo find
// variable que guarda el id de la ruta del editar
let editRoute = parseInt(route.params.id)
// console.log('Estoy en esta ruta', route.name);

const informationComissionPlans = ref({
    nombre: '',
    descripcion: '',
    aplicacion: 1,
    comisionValoresVenta: [],
    comisionValoresOrden: []
})


onMounted(() => {
    if(route.name == 'parameterization.comissionPlans.editComissionPlans'){
        getDatasComissionPlansId()
    }
})

let valuesComissionSale = {}
let valuesComissionOrder = {}

function addSaleComission(){
    if(saleComissionValue1.value == '' || saleComissionValue2.value == '' || percentageComissionValue.value == '')return
    else{
        valuesComissionSale = {
            tipo: 1,
            desde: parseInt(saleComissionValue1.value),
            hasta: parseInt(saleComissionValue2.value),
            comision: parseInt(percentageComissionValue.value)
        }
        informationComissionPlans.value.comisionValoresVenta.push(valuesComissionSale)
    }
    saleComissionValue1.value = ''
    saleComissionValue2.value = ''
    percentageComissionValue.value = ''
}

function addComissionOrder(){
    if(valueComissionOrder1.value == '' || valueComissionOrder2.value == '' || valueComissionPercentage.value == '') return
    else{
        valuesComissionOrder = {
            tipo: 2,
            desde: parseInt(valueComissionOrder1.value),
            hasta: parseInt(valueComissionOrder2.value),
            comision: parseInt(valueComissionPercentage.value)
        }
        informationComissionPlans.value.comisionValoresOrden.push(valuesComissionOrder)
    }
    valueComissionOrder1.value = ''
    valueComissionOrder2.value = ''
    valueComissionPercentage.value = ''
}

function removeSaleComission(i){
    informationComissionPlans.value.comisionValoresVenta = informationComissionPlans.value.comisionValoresVenta.filter((e, index) => index != i)
}
function removeComissionOrder(index){
    informationComissionPlans.value.comisionValoresOrden = informationComissionPlans.value.comisionValoresOrden.filter((e, i) => i != index)
}

async function submitForm(event){
    let sendInformation = await axios.post("api/parametrizacion/planes-de-comision", informationComissionPlans.value)
    router.push({ name: 'parameterization.comissionPlans' })
}

async function editComissionPlan(){
    let updateEdit = await axios.put(`api/parametrizacion/planes-de-comision/${informationComissionPlans.value.id}`, informationComissionPlans.value)
    // console.log('Esto es lo que estamos enviando: ', informationComissionPlans.value);
    router.push({ name: 'parameterization.comissionPlans' })
}

function back(){
    router.push({ name: 'parameterization.comissionPlans' })
}

async function getDatasComissionPlansId(){
    let getDatas = await axios.get(`api/parametrizacion/planes-de-comision/${editRoute}`)
    informationComissionPlans.value = getDatas.data?.data ?? []
}


</script>

<style lang="scss" scoped>


</style>