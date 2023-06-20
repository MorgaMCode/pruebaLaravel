<template>
    <div>
        <el-table
            :data="tableDataActive"
            style="width: 100%;"
            size="large"
            header-cell-class-name="f-16 bg-blue-light-table"
        >
          <el-table-column width="150" >
            <template #default="scope">
                <img :src="scope.row.fotoLogoMini" alt="" class="wh-36 br-2" />
            </template>
          </el-table-column>
          <el-table-column label="Restaurante" sortable prop="restaurante" />
          <el-table-column label="Tiendas" sortable prop="contarTiendas" />
          <el-table-column label="Clasificación" sortable prop="clasificacion" />
          <el-table-column label="Holding" sortable prop="holding" />
          <el-table-column label="Categoría" sortable prop="categoria" />
          <el-table-column label="Plan de comisiones" sortable prop="planComisiones" />
          <template #empty>
            <div class="d-middle-center flex-column" style="height: 55vh;">
                <img src="/img/trash/emptyTable.png" alt="Image sin datos" />
                <p class="text-grey-light f-15 mt-5">No hay solicitudes de nuevos restaurantes</p>
            </div>
          </template>
        </el-table>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

onMounted(() => {
    getDatasRestaurantActive()
})

const props = defineProps({
    searchWordBox: {
        type: String,
        required: false
    }
})
const tableDataActive = ref([])
const newObjects = ref([])
const valueSearch = ref(props.searchWordBox)

watch(() => props.searchWordBox, (newValue) => {
        tableDataActive.value = newObjects.value.filter((r) => r.restaurante.toLowerCase().includes(newValue.toLowerCase()))
    }
)


async function getDatasRestaurantActive(){
    let restaurantActive = await axios.get("api/restaurantes/activos")
    tableDataActive.value = restaurantActive.data?.data ?? []
    newObjects.value = restaurantActive.data?.data ?? []
}

</script>

<style lang="scss" scoped>

</style>