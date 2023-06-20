<template>
    <modal ref="refModalHistorial" :modal-width="669" modal-title="Historial de orden cedida" :see-buttons-bottom="false">
        <div class="py-4">
            <el-table
                :data="historial"
                header-cell-class-name="bg-blue-light-table f-16"
                size="large"
                cell-class-name="py-3"
            >
            <el-table-column width="40" />
              <el-table-column label="Fecha" sortable width="120" >
                <template #default="scope">
                    <p class="f-16">{{ scope.row.fecha }}</p>
                </template>
              </el-table-column>
              <el-table-column label="Hora" sortable width="100" >
                <template #default="scope">
                    <p class="f-16">{{ scope.row.hora }}</p>
                </template>
              </el-table-column>
              <el-table-column label="Tienda" sortable width="145" >
                <template #default="scope">
                    <p class="f-16">{{ scope.row.tienda }}</p>
                </template>
              </el-table-column>
              <el-table-column label="Usuario" sortable >
                <template #default="scope">
                    <p class="f-16">{{ scope.row.usuario }}</p>
                </template>
              </el-table-column>
            </el-table>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref } from 'vue';

const refModalHistorial = ref()

let props = defineProps({
    historial:{
        type: Array,
        required: false,
        default: () => []
    }
})

function open(){
    refModalHistorial.value.open()
}

defineExpose({
    open
})

</script>

<style lang="scss" scoped>

</style>