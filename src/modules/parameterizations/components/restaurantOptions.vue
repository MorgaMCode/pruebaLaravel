<template>
    <div
        class="d-flex flex-column"
        style="width: 513px;"
    >
        <slot></slot>
        <!-- <template v-for="food in things" :key="food.id">
        </template> -->
        <draggable v-model="objectsArray" tag="div" handle=".handle" item-key="id">
            <template #item="{ element }">
                <div class="d-middle mb-2" :class="{ 'mb-4' : mbActive }">
                    <!-- icono izquierdo desplegable -->
                    <i class="icon-dragable f-20 op-02 handle"></i>
                    <!-- imagen del objeto -->
                    <img :src="element.image" alt="">
                    <!-- parrafo que representa el objeto -->
                    <p class="f-20 f-bold ms-3">{{ element.nameTypeThings }}</p>
                    <!-- div contenedor del dropdown de opciones con modales -->
                    <div class="ms-auto me-4">
                        <drodownOptions
                        >
                            <template #default>
                                <el-dropdown-item @click="emit('edit')" >Editar</el-dropdown-item>
                                <el-dropdown-item @click="emit('remove')" >Eliminar</el-dropdown-item>
                                <el-dropdown-item @click="emit('removeConflict')" >Eliminar (conflicto)</el-dropdown-item>
                            </template>
                        </drodownOptions>
                    </div>
                    <!-- cuadro contenedor del numero de restaurantes -->
                    <slot name="numberBoxOne" :actives="element.activos" ></slot>
                    <div class="ms-5 me-4">
                        <slot name="numberBoxTwo" :inactive="element.inactivos" ></slot>
                        <button-switch v-if="seeButtonSwitch" v-model="element.switchButtonActive" />
                    </div>
                </div>
            </template>
        </draggable>
    </div>
</template>

<script setup>
import drodownOptions from '../../../shared/components/dropdownOptions.vue';
import buttonSwitch from '../../../shared/components/buttonSwitch.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    mbActive:{
        type: Boolean,
        default: false
    },
    seeButtonSwitch:{
        type: Boolean,
        default: false
    },
    modelValue: {
        type: Array
    }
})
const objectsArray = ref(props.modelValue)

const emit = defineEmits(['edit', 'remove', 'removeConflict', 'update:modelValue'])

watch(
    objectsArray,
    (newValue) => {
        emit('update:modelValue', newValue)
    },
    { immediate: true }
)

</script>

<style lang="scss" scoped>


</style>