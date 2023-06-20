<template>
    <modal
        ref="recoverRestaurant"
        :modal-width="619"
        modal-title="Recuperar restaurante"
        action="Recuperar restaurante"
        width-button-action="w-200px"
    >
        <div class="ps-3 pe-5 py-3">
            <p class="f-14">
                Al recuperar este restaurante, el administrador podrá ver y gestionar la información.
            </p>
            <p class="f-14 my-3">Selecciona un estado a este restaurante para poder continuar</p>
            <div class="d-flex flex-column mb-2">
                <el-radio v-model="numberValue" label="1" ><p class="f-14 f-light">Activo</p></el-radio>
                <el-radio v-model="numberValue" label="2"><p class="f-14 f-light">Enviar observaciones</p></el-radio>
            </div>
            <p class="f-14 f-light" style="color: #333333;">
                Escribe los cambios que el administrador debe hace en su restaurante para que este pueda ser activado.
                Este mensaje se enviará directamente al administrador
            </p>
            <el-input v-model="inputRecover" placeholder="Agregar" type="textarea" :rows="4" class="mt-3" />
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const recoverRestaurant = ref()
const numberValue = ref('2')
let inputRecover = ''

function open(){
    recoverRestaurant.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>