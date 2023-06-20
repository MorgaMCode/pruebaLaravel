<template>
	<div class="px-5 pt-5 w-100 overflow-auto hidden-scroll">
		<info-top-config subtitle="Clasificación de restaurantes" description="Crea las clasificaciones que otorgan diferentes beneficios a los restaurantes" />
		<div class="mt-5 mb-4">
			<button-action @open="openClassificationModal" />
		</div>
		<template v-if="thingsRange.length">
			<restaurant-options v-model="thingsRange" :seeButtonSwitch="true" @edit="openEditModal">
				<template #numberBoxOne="{ actives }">
					<numberBox
					:useNumber="actives"
					tooltipContent="Restaurantes que usan este tipo"
				/>
				</template>
			</restaurant-options>
		</template>
		<p v-else class="f-15 text-grey-light">No hay clasificaciones creadas</p>
		<modal ref="classficationModal" modalTitle="Crear clasificación" >
			<template #default>
				<modalMain>
					<template #default>
						<div class="mb-3">
							<p class="ms-3 f-16 f-medium">Descripción</p>
							<el-input type="textarea" v-model="description" placeholder="Descripción"></el-input>
						</div>
					</template>
				</modalMain>
			</template>
		</modal>
		<modal ref="editModal" modal-title="Editar clasficacion">
			<template #default>
				<modalMain inputName="Clasificacion de restauante" input="VIP">
					<template #default>
						<div>
							<p class="ms-3 mb-1 f-16 f-medium">Descripción</p>
							<el-input type="textarea" v-model="descripcion" placeholder="" />
						</div>
					</template>
				</modalMain>
			</template>
		</modal>
	</div>
</template>

<script setup>
import infoTopConfig from '../../../../../shared/components/infoTopConfig.vue';
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import restaurantOptions from '../../../components/restaurantOptions.vue';
import buttonSwitch from '../../../../../shared/components/buttonSwitch.vue';
import numberBox from '../../../../../shared/components/numberBox.vue';
import modal from '../../../../../shared/components/modal.vue';
import modalMain from '../../../components/modalMain.vue';
import { ref } from 'vue';

const classficationModal = ref()
const editModal = ref()
const description = ref('')

const thingsRange = ref([
	{ id: 1, image: '/img/trash/medalVip.png', nameTypeThings: 'VIP', activos: 8, switchButtonActive: true },
	{ id: 2, image: '/img/trash/medalGold.png', nameTypeThings: 'Gold', activos: 5, switchButtonActive: true },
	{ id: 3, image: '/img/trash/medalSilver.png', nameTypeThings: 'Silver', activos: 2, switchButtonActive: true },
	{ id: 4, image: '/img/trash/medalDiamante.png', nameTypeThings: 'Diamante', activos: 0, switchButtonActive: false },
])

function openClassificationModal(){
	classficationModal.value.open()
}
function openEditModal(){
	editModal.value.open()
}

const buttonSiwtch = ref(true)
const descripcion = ref('Más visibilidad de sus restaurantes, sugerencias y con promociones exclusivas')


</script>

<style lang="scss" scoped>

</style>