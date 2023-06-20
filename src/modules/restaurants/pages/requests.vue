<template>
    <div>
        <router-view :tableInformationRestaurant="tableListDataFiltered" :busqueda="searchWordBox" />
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

onMounted(() => {
    getDatasRestaurantsList()
})

 const props = defineProps({
    searchWordBox: {
        type: String,
        required: false
    }
 })

watch(() =>
  props.searchWordBox, (newValue) => {
    tableListDataFiltered.value = tableListDatas.value.filter((r) => r.restaurante.toLowerCase().includes(newValue.toLowerCase()))
  }
)


const tableListDatas = ref([])
const tableListDataFiltered = ref([])


async function getDatasRestaurantsList(){
    let listRequests = await axios.get("api/restaurantes/solicitudes")
    tableListDatas.value = listRequests.data?.data ?? []
    tableListDataFiltered.value = tableListDatas.value
}

</script>

<style lang="scss" scoped>

</style>