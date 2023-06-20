<template>
    <div class="px-5 pt-5">
        <infoTopConfig
            subtitle="Categorías de restaurantes"
            description="Crea las categorías de los restaurantes para que los clientes puedan seleccionar rápidamente lo que desean ordenar y los administradores puedan clasificar sus restaurantes"
        />
        <!-- Boton crear-mesutra el modal -->
        <div class="my-3">
            <buttonAction @open="seeModal" />
        </div>
        <!-- Seccion de comida principal -->
        <div v-if="foods.length" class="overflow-auto hidden-scroll h-100 position-relative">
            <restaurantOptions :mb-active="true" v-model="foods" @edit="openFoodModal" @remove="deleteFoodModal" @removeConflict="modalConflict" >
                <template #default>
                    <div class="d-flex gap-4 ms-auto my-2 mb-3 f-15 me-2" >
                        <p class="text-green-clear">Activos</p>
                        <p class="text-whitesmoke">Inactivos</p>
                    </div>
                </template>
                <template #numberBoxOne="{ actives }">
                    <numberBox
                        :use-number="actives"
                        tooltip-content="Restaurantes activos que usand este tipo"
                    />
                </template>
                <template #numberBoxTwo="{ inactive }">
                    <numberBox
                        :use-number="inactive"
                        tooltipContent="Restaurantes inactivos que usan este tipo"
                    />
                </template>
            </restaurantOptions>
            <modal
                ref="seeModalCategories"
                modalTitle="Crear categoría de restaurante"
            >
            <template #default>
                <modalMain></modalMain>
            </template>
            </modal>
            <modal
                ref="modalFood"
                modalTitle="Editar categoría de restaurante"
                action="Guardar"
            >
            <template #default>
                <modalMain input="Mexicano"></modalMain>
            </template>
            </modal>
            <modal
                ref="deleteModal"
                :modalWidth="447"
                modalTitle="Eliminar categoría de restaurante"
                action="Eliminar"
            >
                <template #default>
                    <div class="px-3 py-1 f-14 f-light">
                        <p>Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
                    </div>
                </template>
            </modal>
            <modal
                ref="openModalConflict"
                :modal-width="447"
                modal-title="Eliminar categoría de restaurante"
                :seeButtonsBottom="false"
            >
                <template #default>
                    <div class="px-3 py-1">
                        <p>Se está usando esta categoría de restaurante "mexicano" y no es posible eliminarlo.</p>
                    </div>
                </template>
            </modal>
        </div>
        <p v-else class="f-15">No hay tipos de restaurantes creados.</p>
    </div>
</template>

<script lang="ts" setup>
import modal from '../../../../../shared/components/modal.vue';
import buttonAction from '../../../../../shared/components/buttonAction.vue'
import restaurantOptions from '../../../components/restaurantOptions.vue';
import infoTopConfig from '../../../../../shared/components/infoTopConfig.vue';
import numberBox from '../../../../../shared/components/numberBox.vue';
import modalMain from '../../../components/modalMain.vue';
import { ref, onMounted } from 'vue';


const seeModalCategories = ref()
const deleteModal = ref()
const dialogImageUrl = ref()
const openModalConflict = ref()
const modalFood = ref()
const input = ref('')

const foods = ref([
{
        id: 1,
        image: '/img/trash/tacoMexicano.png',
        nameTypeThings: 'Mexicano',
        activos: 8,
        inactivos: 8
    },
    {
        id: 2,
        image: '/img/trash/burguer.png',
        nameTypeThings: 'Comida rapida',
        activos: 7,
        inactivos: 2
    },
    {
        id: 3,
        image: '/img/trash/pizza.png',
        nameTypeThings: 'Pizzeria',
        activos: 5,
        inactivos: 8
    },
    {
        id: 4,
        image: '/img/trash/cookedChicken.png',
        nameTypeThings: 'Asadero',
        activos: 10,
        inactivos: 1
    },
    {
        id: 5,
        image: '/img/trash/cacke.png',
        nameTypeThings: 'Pasteleria',
        activos: 8,
        inactivos: 8
    },
    {
        id: 6,
        image: '/img/trash/backery.png',
        nameTypeThings: 'Panaderia',
        activos: 8,
        inactivos: 8
    }
])

function seeModal(){
    seeModalCategories.value.open()
}
function modalConflict(){
    openModalConflict.value.open()
}

function openFoodModal(){
    modalFood.value.open();
}
function deleteFoodModal(){
    deleteModal.value.open();
}

</script>

<style scoped lang="scss">
</style>