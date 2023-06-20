<template>
	<div class="mt-3">
		<el-table
			:data="tableInformationRestaurant"
			style="width: 100%%"
			size="large"
			header-cell-class-name="bg-blue-light-table f-16"
			@row-click="toRestaurant"
		>
			<el-table-column width="70">
				<template #default="scope">
					<img :src="scope.row.fotoLogoMini ? scope.row.fotoLogoMini : '/img/trash/backery.png'" alt="image" width="40" height="36">
				</template>
			</el-table-column>
			<el-table-column prop="restaurante" sortable label="Restaurante" width="150" />
			<el-table-column prop="estado" sortable label="Estado" width="100">
				<template #default="scope">
					<stateBox :state-content="scope.row.estado" :showPadding="true" class="el-tag" />
				</template>
			</el-table-column>
			<el-table-column prop="contarTiendas" sortable label="Tienda" width="100" />
			<el-table-column prop="clasificacion" sortable label="Clasificación" width="138" />
			<el-table-column prop="holding" sortable label="Holding" width="94" />
			<el-table-column prop="categoria" sortable label="Categoría" width="124" />
			<el-table-column prop="fechaSolicitud" sortable label="Fecha de solicitud" width="171" />
			<template #empty>
				<div class="d-middle-center flex-column" style="height: 55vh;">
					<img src="/img/trash/emptyTable.png" alt="" />
					<p class="text-grey-light f-15 mt-5">No hay solicitudes de nuevos restaurantes</p>
				</div>
			</template>
		</el-table>
	</div>
</template>

<script setup>
import stateBox from '../components/stateBox.vue';
import { useRouter, useRoute } from 'vue-router';

let router = useRouter()
const route = useRoute()

let props = defineProps({
  tableInformationRestaurant: {
    type: Array,
    required: true
  },
   busqueda: {
    type: String
   }
})

function toRestaurant(i){
  router.push({ name: 'restaurant.seventySeven', params: { id: i.id }})
}
</script>

<style lang="scss" scoped>

</style>