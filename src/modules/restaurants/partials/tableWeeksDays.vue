<template>
    <div>
        <p class="f-16 ms-3">Días de apertura a la semana: <span class="text-whitesmoke f-16">5</span> </p>
        <el-table
            :data="informationTable"
            style="width: 100%;"
            size="large"
            header-row-class-name="f-16 f-medium"
            cell-class-name="border-white"
            header-cell-class-name="border-white"
        >
          <el-table-column label="Día" prop="dia" label-class-name="text-blue" >
            <template #default="scope">
              <p class="text-whitesmoke">{{ scope.row.dia }}</p>
            </template>
          </el-table-column>
          <el-table-column label="Apertura" prop="apertura">
            <template #default="scope">
              <el-table :data="scope.row.aperturas" header-cell-class-name="border-white" :show-header="false" cell-class-name="border-white">
                <el-table-column label="apertura" prop="apertura">
                  <template #default="scope">
                    <p class="text-whitesmoke">{{ scope.row.apertura }}</p>
                  </template>
                </el-table-column>
              </el-table>
            </template>
          </el-table-column>
          <el-table-column label="Cierre">
            <template #default="scope">
                <el-table :data="scope.row.aperturas" :show-header="false" header-cell-class-name="border-white" cell-class-name="border-white">
                  <el-table-column label="Cierre" prop="cierre">
                    <template #default="scope">
                      <p class="text-whitesmoke">{{ scope.row.cierre }}</p>
                    </template>
                  </el-table-column>
                </el-table>
            </template>
          </el-table-column>
          <el-table-column label="Horas" prop="horas" >
            <template #default="scope">
                <p class="text-whitesmoke">{{ scope.row.horas }}</p>
            </template>
          </el-table-column>
        </el-table>
    </div>
</template>

<script setup>
import { ref } from 'vue';

let props = defineProps({
    informationTable: {
        type: Array,
        required: false,
        default: () => []
    }
})


</script>

<style lang="scss" scoped>
.cell{
    color: red !important;
}

</style>