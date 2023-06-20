<template>
    <modal
        ref="deleteModal"
        modal-title="Eliminar restaurante"
        :modal-width="669"
        action="Eliminar"
    >
        <div class="px-3 pb-4">
            <div class="border-whitesmoke br-5 d-flex pe-5 py-2 mb-3" style="background-color: #97A0B01C;">
                <i class="icon-info-outline f-24" />
                <p class="f-14 text-whitesmoke f-medium">
                    Al eliminar el restaurante, el administrador ya no podrá ver la información relacionada con este. Esta acción no se puede revertir y
                    la información del restaurante quedará guardada como un registro.
                </p>
            </div>
            <p class="f-15 text-whitesmoke mb-3 pe-3">Envíale un correo al administrador del restaurante explicando los motivos de eliminación.</p>
            <el-input v-model="file" placeholder="Añadir" type="textarea" :rows="4" />
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const file = ref('')
const deleteModal = ref()

function open(){
    deleteModal.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>