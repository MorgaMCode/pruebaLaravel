<template>
    <el-table
        :data="tablaDomicilios"
        style="width: 100%;"
        size="large"
        header-cell-class-name="f-14 f-medium border-white"
        cell-class-name="border-white"
    >
      <el-table-column label="Rango de distancia">
        <template #default="scope">
            <div class="d-middle text-whitesmoke gap-1 f-14 ms-3">
              <div class="d-middle gap-1 w-60px">
                <p class="">{{ scope.row.distanciaDesde }}</p>
                <span>m</span>
              </div>
                <span>-</span>
                <p class="ps-1">{{ scope.row.distanciaHasta }} </p>
                <span>m</span>
            </div>
        </template>
      </el-table-column>
      <el-table-column label="Valor del domicilio">
        <template #default="scope">
            <p class="text-whitesmoke w-80px">$ <span class="ps-1">{{ scope.row.valor }}</span> </p>
        </template>
      </el-table-column>
      <el-table-column label="Pedido mínimo domicilios gratis">
        <template #default="scope">
            <p v-if="scope.row.pedidoDomicilioGratis !== null" class="text-whitesmoke w-80px">
                <span v-if=" scope.row.pedidoMinimo !== 'No aplica'">$</span>
                <span class="ps-1">{{ scope.row.pedidoDomicilioGratis }}</span>
            </p>
        </template>
      </el-table-column>
      <el-table-column label="Tiempo de entrega">
        <template #default="scope">
            <div class="d-middle gap-1 text-whitesmoke f-14">
              <div class="d-middle gap-1 w-65px">
                <p class="f-14">{{ scope.row.tiempoDesde }}</p>
                <span>min</span>
              </div>
                <span>-</span>
                <p class="ps-1 f-14">{{ scope.row.tiempoHasta }}</p>
                <span>min</span>
            </div>
        </template>
      </el-table-column>
      <el-table-column label="Entrega en los ultimos 4 meses">
        <template #default="scope">
            <p class="text-whitesmoke f-14">{{ scope.row.entregasUltimosMeses }}</p>
        </template>
      </el-table-column>
    </el-table>
</template>

<script setup>

const props = defineProps({
    tablaDomicilios:{
        type: Array,
        required: true,
        default: () => []
    }
})

</script>

<style lang="scss" scoped>

</style>