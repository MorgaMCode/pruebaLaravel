<template>
    <modal ref="refModalCederOrden" modal-title="Ceder orden" :modal-width="476" action="Ceder">
        <div class="px-4 py-3">
            <p class="text-grey-light pb-3 f-15">Selecciona la tienda a la que vas a ceder la orden</p>
            <p class="f-medium ps-3 f-16">Tienda</p>
            <el-select v-model="valueCederTiendaSelect" placeholder="Seleccionar" class="w-100">
              <el-option
                    v-for="select in selectInformation"
                    :key="select.value"
                    :label="select.label"
                    :value="select.value"
                />
            </el-select>
            <div class="d-flex gap-2 border-orange br-5 py-2 pe-5 ps-2 mt-3">
                <div class="d-middle-center wh-24">
                    <i class="icon-alerta text-orange f-25" />
                </div>
                <p class="f-bold text-orange f-14">La tienda seleccionada no tiene disponibilidad en algunos productos y/o toppings</p>
            </div>
            <div v-for="disponibles in disponibilidadEnProductos" class="mt-4 mx-3">
                <p class="f-medium f-16">{{ disponibles.productoName }}</p>
                <template v-if="disponibles.productoName.includes('Toppings no disponibles')">
                    <div v-for="food in disponibles.toppingsFood" class="ms-4">
                        <p class="text-grey-light f-15 py-1">{{ food.burguer }}</p>
                        <template v-for="aditional in food.noDisponible" >
                            <p class="text-orange f-15 ps-4">{{ aditional.adicional }}</p>
                        </template>
                    </div>
                </template>
                <div v-else class="ms-4 mt-2">
                    <template v-for="noDisponible in disponibles.noDisponibilidad" >
                        <p class="text-orange f-15">{{ noDisponible.productos }}</p>
                    </template>
                </div>
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const refModalCederOrden = ref()

const valueCederTiendaSelect = ref(null)

let props = defineProps({
    selectInformation: {
        type: Array,
        required: false,
        default: () => []
    }
})

const disponibilidadEnProductos = ref([
    {
        productoName: 'Productos no disponibles',
        noDisponibilidad: [
            { productos: '· Hamburguesa Classic Rock' },
            { productos: '· Soda Bretaña 250 ml' },
        ]
    },
    {
        productoName: 'Toppings no disponibles',
        toppingsFood:[
            {
                burguer: 'Hamburguesa Classic Rock',
                noDisponible: [
                    { adicional: '· Adicionales - Tocineta' },
                    { adicional: '· Adicionales - Aritos de cebolla' },
                ]
            },
            {
                burguer: 'Papas KISS',
                noDisponible: [
                    { adicional: '· Selecciona tu salsa - BBQ' },
                ]
            }
        ]
    },
])

function open(){
    refModalCederOrden.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>