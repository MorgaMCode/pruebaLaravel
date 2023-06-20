<template>
    <modal ref="modalInactivateRestaurant" modal-title="Inactivar restaurante" :modal-width="669" @button-action="close" >
        <div class="px-3">
            <div class="border-whitesmoke br-5 d-flex pe-5 py-2 mb-4" style="background-color: #97A0B01C;">
                <i class="icon-info-outline f-24" />
                <p class="f-14 text-whitesmoke f-medium">Al inactivar un restaurante, los clientes no podrán ver ninguna de sus tiendas disponibles</p>
            </div>
            <p class="f-15 text-whitesmoke">Dinos el motivo para inactivar este restaurante</p>
            <p class="f-medium f-16 ms-3 mt-2">Motivo</p>
            <el-select
                v-model="value"
                filterable
                placeholder="Seleccionar"
                class="w-100 mb-4"
            >
            <el-option
            v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value"
                />
            </el-select>
            <p class="f-15 text-whitesmoke pe-4 mb-4">Envíale un correo al administrador del restaurante explicando los motivos de inactivación.</p>
            <el-input v-model="text" type="textarea" placeholder="Añadir" :rows="5" />
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const modalInactivateRestaurant = ref()
const value = ref('')

let options  = [
    {
        value: 'Option1',
        label: 'Option1'
    }
]

function open(){
    modalInactivateRestaurant.value.open()
}

function close(){
    modalInactivateRestaurant.value.close()
}

defineExpose({
    open,
    close
})

</script>

<style lang="scss" scoped>

</style>