<template>
    <modal
        ref="openModal"
        :modal-width="737"
        modal-title="Historial plan de comisión"
        :see-buttons-bottom="false"
    >
        <div class="px-3 py-2">
            <el-table
                :data="history"
                style="width: 100%;"
                header-cell-class-name="f-16 f-bold bg-blue-light-table"
                size="large"
            >
              <el-table-column label="Plan de comisión" sortable prop="planComision" />
              <el-table-column label="Fecha de asignación" sortable prop="fechaAsignacion" />
              <el-table-column label="Responsable" prop="responsable" />
            </el-table>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const openModal = ref()

let props = defineProps({
    history: {
        type: Array,
        required: false
    }
})

function open(){
    openModal.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>